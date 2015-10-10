# Amazon Wish List Browser

A code sample that uses <a href="http://doitlikejustin.github.io/amazon-wish-lister/">Amazon Wish Lister</a> API to browse an Amazon Wish List using PHP, Bootstrap, Smarty templates, and a Redis datastore for caching API results, all available on an AWS EC2 instance.

AWS endpoint:
- http://52.24.26.122/wishlist/

Application details:
- Custom MVC architecture.
- Flat include structure minimizes class overhead.
- Smarty template engine.
- Mobile-ready responsive design using Bootstrap.
- Uses Redis datastore to cache Amazon wish list data per user ID.
- runs on Ubuntu Trusty instance in AWS EC2.
- deploys from GitHub using AWS CodeDeploy.
- includes scripts needed to create additional EC2 instances.

To do (work in progress):
- UI/UX improvements.
- sorting by priority, date added, title, price.
- pagination.
- AWS integration:
-- deploy from GitHub using AWS CodeDeploy.
-- run on Ubuntu Trusty instance in AWS EC2.
- error handling.
- class interfaces.
- unit tests.
