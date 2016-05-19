# Amazon Wish List Browser

A code sample that uses <a href="http://doitlikejustin.github.io/amazon-wish-lister/">Amazon Wish Lister</a> API to browse an Amazon Wish List using PHP, Bootstrap, Smarty templates, and a Redis datastore for caching API results, all available on an AWS EC2 instance.

AWS endpoint:
- ~~http://52.34.94.41/wishlist/?id=3XFAFTBCX52X&co=1~~ (inactive as of 5/2016)

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
- some Smarty vars not cached by Redis (so carousel images don't appear, for example).
- UI/UX improvements.
- sorting by priority, date added, title, price, price drop.
- pagination.
- error handling.
- class interfaces.
- unit tests.
