---
extends: _layouts.post
section: content
title: Vagrant and VirtualBox and Provisioning, Oh My!
date: 
created_at: 2013-12-30T17:13:51.000Z
updated_at: 2014-01-02T16:05:38.000Z
published_at: 
description: Vagrant and VirtualBox and Provisioning, Oh My!
cover_image: /assets/img/post-cover-image-2.png
---

So, now that I've got the default installation of Laravel, I need to be able to run it. I do all of my development on my Macbook, which is good, but has a vastly different configuration than my Ubuntu production server. And I want to make sure that I am developing in an environment as close to production as possible. 

This is the realm of virtual machines. I can spin up a VM that runs with the same configuration as my production server and my application can be developed and run as if it was live. [VirtualBox](https://www.virtualbox.org/) is a great solution for running VMs and is free to use.

Now, this is all well and good, but if I have a friend or team member who is working on the project as well, I want he or she to be using the same environment. And sending around VirtualBox's files for a VM is pretty hefty. I mean, imagine checking those files into git. Nasty. 

But what if I could just commit a configuration file that dictates how a VirtualBox VM should be created? It would be lightweight, and easy to share. Plus it ensures that every developer is using the same environment. That's the idea behind [Vagrant](https://www.vagrantup.com/).

## Vagrant
Vagrant is a fantastic command line tool that lets you easily create, use, and delete virtual machines for development. In two commands, you can initialize and boot an Ubuntu 12.04 LTS 64-bit server.

	$ vagrant init precise64 https://files.vagrantup.com/precise64.box
	$ vagrant up

The first command does a few things. It creates a `Vagrantfile` in your current directory that dictates the configuration of your vagrant machine. It also creates a box (preconfigured vagrant machine) named "precise64" that comes from the url to the precise64.box file. If you open the `Vagrantfile` you'll see that it is configured to use this box.

The second command boots the vagrant machine. If it is the first time this machine has been booted, it will also do any installation setup. Now, this part is very important because this is the step where vagrant will configure your machine with the necessary packages you need. By predefining your provisioning, you ensure that when any new person grabs a copy of the project to work on it, `$ vagrant up` is the only command needed to be up and running.

## Provisioning
Provisioning your vagrant machine can be as complex as your situation requires. Vagrant supports provisioning in several different ways, including [Puppet](https://puppetlabs.com/) and [Chef](https://www.getchef.com/). However, simpler provisioning can just be done through bash scripts, which is simple enough for our needs.

By creating a simple bash script in our project, we can automatically run package installation commands when the vagrant machine is created. To get vagrant to run this script, add the following to your config section of the `Vagrantfile`.

	config.vm.provision :shell, :path => "bootstrap.sh"
    
This will tell vagrant to run your shell script. Now, to get all of our packages we need, there is a lot of stuff we need to install using this script. Thankfully, fellow developer [Chris Fidao](https://fideloper.com/) has created a GitHub repository that contains common vagrant provisioning bash scripts.

### Vaprobash
[Vaprobash](https://github.com/fideloper/Vaprobash) is a `Vagrantfile` and accompanying bash scripts to provision the basic LAMP or LEMP stack. It uses the ondrej PHP 5.5 package, as well as includes other scripts for things like vim and composer. Using this as the basis for Forge's vagrant provisioning, I made a couple of adjustments to mimic my production server.

#### MariaDB
MySQL is a pretty commonly used database for most projects. Almost every web developer has in one point or another used it. MariaDB is a fork of that project maintained by some of the original developers of MySQL. It is an almost 1:1 drop-in replacement for MySQL, and any applications running on MySQL (like Wordpress) migrate seamlessly to MariaDB. I currently run MariaDB 10.0 on production.

So, in order to provision MariaDB, I made a few changes to the provisioning scripts. I created a `mariadb.sh` script based upon `mysql.sh`. Then I added in a few lines to pull from the MariaDB repo. The result was this:

	echo ">>> Installing MariaDB Server"

	# Install MariaDB without password prompt
	# Set username and password to 'root'
	sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
	sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
    
    # Add repo for MariaDB
	sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xcbcb082a1bb943db
	sudo add-apt-repository 'deb https://mirror.jmu.edu/pub/mariadb/repo/10.0/ubuntu precise main'

	# Update
	sudo apt-get update

	# Install MariaDB Server
	sudo apt-get install -y mariadb-server
    
This script will install MariaDB 10.0 for Ubuntu 12.04 LTS. Notice that the `debconf-set-selections` command still uses `mysql-server` settings. As I said before, MariaDB is a drop-in replacement for MySQL, so everything stays the same.

#### Nginx
The nginx installation using Vaprobash installs the latest version of nginx. There were only a few changes that I made to the site configuration for vagrant.

First was I changed the root from `/vagrant` to `/vagrant/public` for the Laravel application. Second, I changed the server_name to a name I defined in my hosts file since I don't use xip.io. Lastly, I changed some configurations to set the `LARAVEL_ENV` variable to `development` since that is the environment I work in. 

Finally, I updated my `Vagrantfile` to provision all the scripts I require. The result is this:

	Vagrant.configure("2") do |config|
  
  	config.vm.box = "precise64"
  	config.vm.box_url = "https://files.vagrantup.com/precise64.box"
  	config.vm.network :private_network, ip: "192.168.33.10"
  	config.vm.synced_folder ".", "/vagrant",
            id: "core",
            :nfs => true,
            :mount_options => ['nolock,vers=3,udp,noatime']
    
      # Provision Nginx, PHP 5.5, and PHP-FPM
      config.vm.provision "shell", path: "./vagrant-scripts/lemp.sh"
    
      # Provision MariaDB
      config.vm.provision "shell", path: "./vagrant-scripts/mariadb.sh"
    
      # Provision Composer
      config.vm.provision "shell", path: "./vagrant-scripts/composer.sh"
    
    end
    

