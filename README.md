# PHP5 Code Sample
A code sample that makes API requests to product list and single-product APIs, using PHP, Smarty templates, and a Redis datastore for caching API results, all available on an AWS EC2 instance.

Endpoints:
- http://52.24.26.122/products/
- http://52.24.26.122/deals/

Application details:
- MVC architecture.
- flat include structure minimizes class overhead.
- Smarty template engine.
- uses Zend OpCache to improve performance by caching PHP opcode.
- runs on Ubuntu Trusty instance in AWS EC2.
- deploys from GitHub using AWS CodeDeploy.
- includes scripts needed to create additional EC2 instances.
- uses Redis datastore to cache product API results to improve performance (from >1s to <500ms).

To do:
- cache products API call for additional performance increase (~400ms improvement).
- remove tight coupling of classes.
- write Cache class to set Redis expiration policy and delete method.
- error handling.
- unit tests.
- impression and click-out tracking.

Notes:
- Added deals endpoint to shpow Top-n Daily Deals. However, since product API does not return price, use SKU as proxy and return top-n from alphabetically sorted deals. (July 17, 2015)
- Smarty template caching cannot be used because of dynamic content. (May 31, 2015)


