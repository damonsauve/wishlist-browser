# Amazon Wish List Browser

A code sample that uses <a href="http://doitlikejustin.github.io/amazon-wish-lister/">Amazon Wish Lister</a> API to browse an Amazon Wish List using PHP, Smarty templates, and a Redis datastore for caching API results, all available on an AWS EC2 instance.

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
- error handling.
- unit tests.
