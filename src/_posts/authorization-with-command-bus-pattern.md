---
extends: _layouts.post
section: content
title: Authorization with Command Bus Pattern
date: 
created_at: 2014-12-01T16:44:37.000Z
updated_at: 2014-12-01T16:44:37.000Z
published_at: 
description: Authorization with Command Bus Pattern
cover_image: /assets/img/post-cover-image-2.png
---

Authorization command bus decorator
AuthorizedCommand defines how an action should be authorized, provides user w/ permissions
TenantAuthorizedCommand example base Command that verifies user is performing an action for only their company in a multi-tenant application

