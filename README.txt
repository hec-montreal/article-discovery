The article_discovery module intends to be an interface to Web-Scale Discovery
services like Serials Solutions' Summon.  Initially, only Summon will be
supported, but in future versions we will explore making the module more
generally usable.  As the name suggests, there is a particular focus on
searching for article-like records rather than books in a library's holdings.
That doesn't mean it can't be done, it just means that some features like
checking on catalog availability status are not on our current feature
roadmap.

For more information about Serials Solutions' Summon, see:
http://www.serialssolutions.com/summon/

To use this module, you will need to (a) have a Summon subscription with
access to the API, and (b) obtain the PHP 5 Summon API library from Serialis
Solutions.  (a) Will likely require money on your part.  (b) Is freely
available code released under the GPL.  Drupal.org discourages mirroring such
software so it is not included in this release.  The URL for the Summon API
library is
http://api.summon.serialssolutions.com/help/api/sites/default/files/Summon.class.zip,
and it it linked from http://api.summon.serialssolutions.com/help/api/code.
If it is no longer available at either of those locations, feel free to
contact the module's authors and they should be able to get you a copy.

Configuring
-----------

Once you've installed this module you'll need to configure it.  The
configurations available from a settings form at a menu path for
admin/settings/article_discovery.  Here you can configure your Summon ID, 
API secret key, link resolver, and a handful of other options.

With Summon's configuration complete, the final step is to place the search box
block, and the facet block.  The expectation is that the search box will be
installed either in the header area, and that the facets are installed in a
sidebar.
