---
extends: _layouts.post
section: content
title: Unit Testing Revelation
date: 2013-12-11
created_at: 2013-12-11T00:22:07.000Z
updated_at: 2014-01-03T16:31:30.000Z
published_at: 2013-12-11T00:27:19.000Z
description: Unit Testing Revelation
cover_image: /assets/img/post-cover-image-2.png
---

I’ve been doing application development for several years now. Through most of that experience and during my schooling, I never quite understood how and what to test, and more so, how to do test **well**. At one point, I decided that I needed to learn more about testing methodology in order to better understand how to test better. What I learned helped me change my views on testing as a whole and helped me become not just a better developer, but a better software architect.

Whenever I tried to write unit tests, I always felt that they were inadequate and that they weren’t testing the right things. I also kept finding myself having to include several dependencies into the equation, which didn’t help testing, and definitely compromised the isolation of my unit, which is the whole idea behind unit testing in the first place. When I found [this article by Martin Fowler](https://martinfowler.com/articles/mocksArentStubs.html), I had my big “AHA” moment in testing: the difference between state and behavior testing.

#State vs. Behavior Testing
Not all unit tests are created equal. Both styles of testing accomplish the same goal, ensuring that the tested unit of the application performs it’s operations correctly. The difference is how these methodologies accomplish said goal.

##State Verification
Let’s start with the classical style or state-driven testing first.
```
// Adapted from Martin Fowler
[TestClass]
public class OrderStateTester 
{
    private static String TALISKER = "Talisker";
    private static String HIGHLAND_PARK = "Highland Park";
    private Warehouse warehouse = new WarehouseImpl();
    
    [TestInitialize]
    protected void setUp() 
    {
        warehouse.add(TALISKER, 50);
        warehouse.add(HIGHLAND_PARK, 25);
    }
    
    [TestMethod]
    public void testOrderIsFilledIfEnoughInWarehouse() 
    {
        Order order = new Order(TALISKER, 50);
        order.fill(warehouse);
        Assert.IsTrue(order.isFilled());
        Assert.Equals(0, warehouse.getInventory(TALISKER));
    }
    
    [TestMethod]
    public void testOrderDoesNotRemoveIfNotEnough() 
    {
        Order order = new Order(TALISKER, 51);
        order.fill(warehouse);
        Assert.IsFalse(order.isFilled());
        Assert.Equals(50, warehouse.getInventory(TALISKER));
    }
}
```
    
Here we see a simple unit test following the model of Arrange, Act, Assert. This test covers the ability for an order to be filled from the stock of a warehouse, failing if no inventory is available. Each test starts by Arranging the players in the operation. The Order is created with the specified warehouse and inventory number requested. Then the test performs it’s Act phase, which attempts to fill the order. Then are two tests Assert if the order was filled, and that the warehouse had its stock removed according to the number requested by the order.

In this case, there are two things of note. First, we are using an actual implementation of a `Warehouse` to perform some of our actions. That is because in order to test the `Order.fill()` method, a `Warehouse` object must be passed as a parameter. Second, is how we verify our test success in the Assert phase. We verify the final state of our application after the operations have been fulfilled. This **state verification** is what defines the classical style of unit testing.

##Behavior Verification
Now let’s test the same functionality using the mockist style of testing.
```
[TestClass]
public class OrderBehaviorTest
{
    private static String TALISKER = "Talisker";
    
    [TestMethod]
    public void testFillingRemovesInventory()
    {
        // Arrange
        Order order = new Order(TALISKER, 50);
        var mock = new Mock<Warehouse>();
        mock.Setup(x => x.hasInventory()).Returns(true);
        mock.Setup(x => x.remove(TALISKER, 50));
        
        // Act
        order.fill(mock.Object);
        
        // Assert
        mock.Verify();
        Assert.IsTrue(order.isFilled());
    }
    
    [TestMethod]
    public void testFillingFails()
    {
        // Arrange
        Order order = new Order(TALISKER, 51);
        var mock = new Mock<Warehouse>();
        mock.Setup(x => x.hasInventory()).Returns(false);
        
        // Act
        order.fill(mock.Object);
        
        // Assert
        Assert.IsFalse(order.isFilled());
    }
}
```
    
Here, we can see that we are verifying the same operation, the filling of an order. However, how we achieve that is much different. This methodology uses mock objects in place of actual implementations for the classes that we are not explicitly testing. This helps keep our unit test focused on that specific unit, isolating it from other parts of our system that should be testing independently.

For our mock objects, which have been created by the [Moq Framework](https://www.moqthis.com/), we setup the actions that we expect to be called during our Act phase and how those actions should respond. Notice that because we verify the behavior and not the state of the warehouse, we don’t need to worry about any logic correctly dictating whether or not our `Warehouse.hasInventory()` method will return the correct value. We explicitly state what result occurs. We can even specify the expected parameters for these mocked method calls, so that if `Order.fill()` incorrectly passes values, our test will know. (Check the documentation for your chosen mocking library to find out how explicit you can be with constraining the allowed behavior).

#In Conclusion
I’ve found that understanding this fundamental difference in testing styles has helped me in thoroughly testing my applications. Some people strictly adhere to one of the two methodologies, but I find that using a combination of both to fit my needs quite well. For small applications, if it helps me test quicker, I’ll write a classical test. However, most of the time I usually have some mocking library in use to isolate my unit testing. But even when I use mocking for my unit tests, I still sometime write integration tests that test multiple parts of the system at once, classical state tests are the way to go. In the end, it really just comes down to what problem you are trying to solve, and which tools best equip you to solve them.
