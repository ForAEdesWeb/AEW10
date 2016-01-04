<?php die("Access Denied"); ?>#x#a:2:{s:6:"output";s:0:"";s:6:"result";a:5:{i:0;O:8:"stdClass":3:{s:4:"link";s:98:"http://virtuemart.net/news/latest-news/470-release-vm3-0-8-2-secured-by-fortinet-s-fortiguard-labs";s:5:"title";s:56:"Release VM3.0.9, secured by Fortinet’s FortiGuard Labs";s:11:"description";s:3499:"<div><p>As we mentioned in the last news, VirtueMart is audited by different security companies. We are very happy that they found the persistent XSS attack before we released vm3.0.8, so the version vm3.0.8 already contains the fix.</p>
<p>The vulnerability discovered by <a href="http://www.fortiguard.com/encyclopedia/vulnerability/#id=40479">Fortinet’sFortiGuard Labs</a> with CVE number “CVE-2015-3619” is a persistent XSS attack. Contrary to non-persistent XSS, this kind of attack can be executed with almost nil interaction by the admin. The problem exists due to the javascript tooltips, which automatically decode the DOM value. So in certain circumstances it was possible to use a double encode combination of first_name, last_name and company to create a working js, which gets activated if an admin hoovers over the combined name of the order. So our fix contains two parts. One part makes it impossible to store dangerous values, the other part escapes the tooltips to prevent problems with old orders.</p>
<p>The fix in vm2admin.js is here <br /><a href="http://dev.virtuemart.net/projects/virtuemart/repository/diff/trunk/virtuemart/administrator/components/com_virtuemart/assets/js/vm2admin.js?utf8=%E2%9C%93&amp;rev=8828&amp;rev_to=8670">vm2admin.js rev=8828</a><br />In case you cannot update, just use the new vm2admin.js.</p>
<p>The other fixes are more complex and in different files and just prevent the problem for the future.</p>
<ul>
<li><a href="http://dev.virtuemart.net/projects/virtuemart/repository/diff/trunk/virtuemart/administrator/components/com_virtuemart/models/orders.php?utf8=%E2%9C%93&amp;rev=8828&amp;rev_to=8821">/models/orders.php rev=8828</a></li>
<li><a href="http://dev.virtuemart.net/projects/virtuemart/repository/diff/trunk/virtuemart/administrator/components/com_virtuemart/views/orders/tmpl/orders.php?utf8=%E2%9C%93&amp;rev=8828&amp;rev_to=8539">BE/views/orders/tmpl/orders.php rev=8828</a></li>
<li><a href="http://dev.virtuemart.net/projects/virtuemart/repository/diff/trunk/virtuemart/administrator/components/com_virtuemart/views/orders/tmpl/order.php?utf8=%E2%9C%93&amp;rev=8828&amp;rev_to=8536">BE/views/orders/tmpl/order.php rev=8828</a></li>
</ul>
<p>Please remember that all this fixes are already in vm3.0.8. This is just the disclosure.</p>
<p>Meanwhile we created a new vm3.0.9, which is also suitable for productive use. But test your "add to cart" popup. Also, editing of orders could behave differently.</p>
<p>Features:<br />- New Ordering "ordering, name", which sorts for ordering if available, then for name.<br />- If a product had more than one category and one was not publisehd it could happen that the selected category was the unpublished one. Is fixed.<br />- Order item edit now uses the same function as the create/update function, which allows to use the same triggers for manipulating storing of the data. <br />- "Give vendors switched in shoppers their rights", means a vendor switched into a shopper can still administrate the store.<br />- Klarna replaced serialize against json_encode<br />- Added the option to add js files inline (sometimes easier with ajax)<br />- Add to cart can now be stopped by another js using e.stopSendtocart == true<br />- Added test for the AIO to prevent blank page due to installion without proper VirtueMart core</p>
<p><a href="http://dev.virtuemart.net/projects/virtuemart/files">http://dev.virtuemart.net/projects/virtuemart/files</a></p>
<p>&nbsp;</p></div>";}i:1;O:8:"stdClass":3:{s:4:"link";s:67:"http://virtuemart.net/news/latest-news/469-security-release-vm3-0-8";s:5:"title";s:24:"Security release Vm3.0.8";s:11:"description";s:6534:"<div><p>Security release VM 3.0.8</p>
<p>Finally after some interim versions, here is the release of VirtueMart 3.0.8.</p>
<p>All fixes were already provided with VM 3.0.6. Additionally we released VM 3.0.6.2 to minimize problems due last security problem in PHP itself (<a href="https://github.com/80vul/phpcodz/blob/master/research/pch-020.md">https://github.com/80vul/phpcodz/blob/master/research/pch-020.md</a>).</p>
<p>The other two vulnerabilities were minors (non-persistent XSS) and described here: <br /><a href="http://dev.virtuemart.net/projects/virtuemart/repository/revisions/8692/diff/trunk/virtuemart/administrator/components/com_virtuemart/helpers/vmpagination.php">.../8692/diff/trunk/virtuemart/administrator/components/com_virtuemart/helpers/vmpagination.php</a><br /><a href="http://dev.virtuemart.net/projects/virtuemart/repository/revisions/8692/diff/trunk/virtuemart/administrator/components/com_virtuemart/models/product.php">.../8692/diff/trunk/virtuemart/administrator/components/com_virtuemart/models/product.php</a>.</p>
<p>So what happened in the meantime?<br />Well, our dear fellow Joomla developers kept us even more busy than usual. :-) We were forced by different circumstances to release minor interim versions. First, we had to react fast to different problems in Joomla. For example in February we were informed by "<a href="http://appcheck-ng.com/">Appcheck NG</a>", that we were distributing the dangerous file 'uploader.swf' in our Joomla 2.5.x/VM 3.0.x full-installer. After some investigations it became clear, that the file was still distributed by Joomla and was only removed when users updated Joomla. The file has been known as dangerous since J2.5.10, but is still present in the J2.5.28 installer. So we removed the file from our package and added a remove function to our install and update function of VirtueMart <strong>2.6.16+</strong> and <strong>3.0.6+</strong> to ensure that the file is deleted.</p>
<p>Some days later, after we had just adjusted the toolbar javascript to Joomla 3.4.0, version 3.4.1 was released, which broke the validation.js of the toolbar's 'Save' button. The reasons were "optimisations" and "deferrable" changes of low priority issues. In our humble opinion the reason for this probably is the new release strategy of Joomla not having short term and long term releases. We do welcome that Joomla dropped the STR and LTR system, but the new system seems to miss clear rules about which kind of features are allowed to be added within a minor update version. I think the VirtueMart community has already had their fingers burned by the constant implementation of new features. It took us some releases to get a feeling for it and it is a matter of experience and rules. Since Joomla has a more mutating team than VM, it would be better for the Joomla team to write down their knowledge in rules. It remains very interesting as to how the Joomla community will deal with this situation. From a developers point of view, in the past we had to ensure compatibility only for major releases, like j1.0, 1.5, j2.5, 3.3. At present it seems we have to cope with minor releases like 3.4.x, 3.5.x and so on, too. Or to put it bluntly: Joomla becomes unstable. For a developer stable/unstable means not just that the execution of the program is stable, it usually also means that the program behaves the same way as before.</p>
<p>I wrote the above 1 week ago and meanwhile we are suffering from new problems with routing of the language in Joomla 3.4.1, a new problem with canonical urls and more. So let's hope that all the currently open router/SEF fixes, viewable at <a href="http://issues.joomla.org/tracker/joomla-cms/?sort=issue&amp;direction=desc&amp;user=undefined&amp;category=router-sef&amp;stools-active=1">issues.joomla.org/tracker/joomla-cms/?category=router-sef</a> will be tested and merged into Joomla as soon as possible. A half baked new router system creates many problems for us.</p>
<p>Since there are still security audits for Joomla 2.5.28, even after the announced End Of Life, we currently recommend that multilingual shops stay with Joomla 2.5.28 until we have a stable Joomla 3.4.x or 3.5 version. Our <a href="http://extensions.virtuemart.net/support/virtuemart-supporter-membership-detail">Supporter Membership</a> implies a security maintenance contract and ensures a stable and secure system.</p>
<p>As many live shops show, staying with Joomla 2.5.28 doesn't mean, the system is not responsive or not mobile friendly. There are great templates in the market that offer all the mobile friendly features that are necessary to have an up-to-date e-commerce system with a stable Joomla 2.5 backbone.</p>
<p>We really worked hard on the new version and besides fixing bugs, we also added some features.</p>
<ul>
<li>The vmbeez template is now mobile friendly (Kudos to Stefan Schumacher)</li>
<li>New option for Multivariants, which automatically creates the selected customfield "string" in the childs for you. This is very important for search plugins</li>
<li>multi variant gives correct numbers of rows (for browsepage)</li>
<li>new Sampledata with new images</li>
<li>added more not null declarations for sql <a href="http://dev.mysql.com/doc/refman/5.7/en/is-null-optimization.html">http://dev.mysql.com/doc/refman/5.7/en/is-null-optimization.html</a></li>
<li>Fallbacks for IE9, various js, missing config values and similar</li>
<li>category name understands vmText language keys</li>
<li>Added extra option to "is_list" for the customfields S and M</li>
<li>Address handling in cart is enhanced</li>
<li>Example for making the code more robust: creating of children had a limited due the slug finder (was not doing more than 20 tries). The new function uses the slug of the most recent generated child to find a new slug.</li>
<li>Another example: Added function ensureUniqueId&nbsp;to keep all html id tags to ensure unique id tags (not implement for any html function, yet)</li>
<li>or Vmprices addtocart works now also with entity button, not just input</li>
<li>added vRequest::vmSpecialChars without double encoding, the reason is that lang can be a command in php (thx to Kainhofer for hint and patch)</li>
<li>and a lot more, you may investigate the repository yourself <a href="http://dev.virtuemart.net/projects/virtuemart/repository/show/trunk/virtuemart">dev.virtuemart.net/.../trunk/virtuemart </a></li>
</ul>
<p>Furthermore we released the new vm2.6.18, just minor bugfixes.&nbsp;</p></div>";}i:2;O:8:"stdClass":3:{s:4:"link";s:101:"http://virtuemart.net/news/latest-news/468-virtuemart-3-0-6-with-completely-redesigned-multi-variants";s:5:"title";s:60:"VirtueMart 3.0.6 with completely redesigned 'Multi Variants'";s:11:"description";s:3180:"<div><p>In VirtueMart 3.0.6 we fine tuned the completely redesigned <strong><em>Multi Variants</em></strong> which were introduced in our previous release. Let me give you a short introduction.</p>
<p>One of the most advanced feature of an ecommerce store is the possibility to display different variants of one product in a clear structure. The typical example are the T-Shirt product variants. We have created a small example here: <a href="http://demo.virtuemart.net/default-products/vm-t-shirt-multi-variant-detail">http://demo.virtuemart.net/default-products/vm-t-shirt-multi-variant-detail</a>.</p>
<p>Not all colours are available for any size and due to aesthetic reasons the "blue" imprints are not available for the "blue" coloured T-Shirt. Any drop-down combination points to a real product. The handling is easy as most important product attributes are accessible from the parent product (variant attributes, Sku, price). So you can easily configure more than 50 product variants in a single view, with different stock levels, price and images. If you select an already existing attribute like length, weight, etc, then you can change the value directly using the drop-down matrix in the parent product. You can also modify the display (for example rounding).</p>
<p><img src="http://virtuemart.net/images/virtuemart/news/childvariantsmatrix.PNG" alt="Variant Matrix" title="Variant Matrix" class="caption" width="692" height="196" /></p>
<p>We added a new configurable automatically selected shipment and payment if more than one is available. Also the long desired feature "register as admin in the frontend" got added.&nbsp;We also cleaned up the Custom Fields tab in the Product Edit view to give more room for Custom Field configurations. VirtueMart 3.0.6 is also&nbsp;a lot faster, due to new mysql keys and more caching. The administration menu is now still usable while being collapsed.</p>
<p>There is a new keepAlive script, which automatically extends the session for your shoppers if there is a product in the cart. It also automatically extends the session lifetime in all backend views. It is checking for input, so it is not running endlessly. As an example, if your session time is set to 30 minutes and your guest is checking out, leaving the computer (with open browser) and returning after 50 minutes, he is still logged in. If the user is now interacting with the screen (clicking, typing), then the keepAlive scripts directly fires a keepAlive and extends the session again. Lets assume the user stores his data after 70 minutes (searching for his/her credit card), the session is still alive. <br /><br /></p>
<p>We strongly recommend anyone using an older version of VM3 to update. The release is heavily tested and some changes and fixes were done especially for 3rd party developers.</p>
<div>
<p><a href="http://virtuemart.net/download">DOWNLOAD VM3 NOW<br /> VirtueMart 3 component (core and AIO)</a></p>
</div>
<p>There is also a small update for vm2.6 series. There are also new keys for the sql joins to speed up your store. Also the new js handler got added for easier compatibility between vm2.6 andd vm3 extensions.</p></div>";}i:3;O:8:"stdClass":3:{s:4:"link";s:70:"http://virtuemart.net/news/latest-news/467-release-of-virtuemart-3-0-4";s:5:"title";s:27:"Release of VirtueMart 3.0.4";s:11:"description";s:2987:"<div><p>A bit earlier than expected, we have to release vm3.0.4 to close a vulnerability in the core. This is a real vulnerability, no exploit. The problem is a wrong error report setting, which can reveal the used server path for the real attack.</p>
<p>More and more people use php5.4 or php5.5, which has another default error handling and so they sometimes displayed Strict Errors (revealing the path). To prevent this, we added a function to disable the "Strict Standards" reporting for the "default" and "none" setting in Joomla. Unluckily, we left for a special debugging case the setting on enabled. So regardless the used configuration setting, you always got at least the "Simple" setting. Luckily it is not so easy to create warnings and errors in VirtueMart 3.</p>
<p>In case you don't want to update, here is the manual fix:</p>
<ol>
<li>open the file config.php at /administrator/components/com_virtuemart/helpers/config.php.</li>
<li>Go to line 583 and replace <br />ini_set('display_errors', '1');<br /> with<br /> ini_set('display_errors', '0');</li>
</ol>
<p>Or just download the new version.</p>
<p>The layout changes of the new version are just one important one for people who override the sublayout prices. The sublayout prices.php had a &lt;div class="clear"&gt;&lt;/div&gt; at the end, which got removed to increase the flexibility of the sublayout.</p>
<p>The new version contains a new sample product, the "child variant", which allows you to use up to 5 dropdowns to determine the product variant. It is similar to the stockable plugin, but allows also changing the variant data of any child directly from the parent. The handling of the feature is not perfect yet, but a good start. Feel free to share your ideas on our forum.</p>
<p>New features and bug fixes:</p>
<ul>
<li>cleaning of the code</li>
<li>increased robustness</li>
<li>increased consistency</li>
<li>more j3 compatibility (minors)</li>
</ul>
<ul>
<li>added js to fire automatically the checkout (without redirect) to show directly confirm</li>
<li>link to manufacturer on the productdetail page calls the manufacturer, not any longer the product list of the manufacturer</li>
<li>the rss feed in the controlpanel is now loaded by ajax, to prevent that the controlpanel isn't loaded if rss has problems</li>
<li>custom media, related products and categories with image size parameter</li>
</ul>
<ul>
<li>added var to vmview "writeJs", for example to prevent writing of js in pdfs</li>
<li>added hash for categoryListTree</li>
<li>changed calculator so, that default userfield parameters are better directly set if instantiated. Less problems with tax by country for guests</li>
<li>fixed in vmplugin.php the function declarePluginParams</li>
<li>fixed trigger plgVmDeclarePluginParamsUserfieldVM3</li>
</ul>
<p>and some more.</p>
<div>
<p><a href="http://virtuemart.net/download">DOWNLOAD VM3 NOW<br /> VirtueMart 3 component (core and AIO)</a></p>
</div></div>";}i:4;O:8:"stdClass":3:{s:4:"link";s:105:"http://virtuemart.net/news/latest-news/466-klik-pay-is-included-in-virtuemart-2-6-14-and-virtuemart-3-0-2";s:5:"title";s:68:"Klik &amp; Pay is included in VirtueMart 2.6.14 and VirtueMart 3.0.2";s:11:"description";s:4370:"<div><p>We are pleased to announce the release of VirtueMart 2.6.14 and VirtueMart 3.0.2.</p>
<p><img src="http://virtuemart.net/images/klikandpay/klikandpay-logo.png" alt="Klik&amp;Pay included in VirtueMart" style="margin-left: 5px; margin-bottom: 5px; float: right;" />Klik &amp; Pay is a holistic secured payment solution accessible via PC, tablets and/or smartphone. Partners with many Banks and International acquirers, Klik &amp; Pay assists its merchants for 15 years, in France, Europe and all over the World. Klik &amp; Pay is:</p>
<ul>
	<li>A global solution not requiring a DSA</li>
	<li>A competitive pricing, without monthly fees nor set-up fee</li>
	<li>An anti-fraud scoring linked to an account with or without 3D Secure</li>
	<li>A multi-lingual staff available by telephone and email</li>
	<li>A consulting service to help you to develop your business and assist you at an International level</li>
</ul>
<p>Optimize your conversion rate:</p>
<ul>
	<li>Multi currencies cashing</li>
	<li>Multi lingual payment pages</li>
	<li>3DS and non 3 DS merchant account with trigger point</li>
</ul>
<p>Increase Sales:</p>
<ul>
	<li>Virtual Payment Terminal</li>
	<li>Payment by email</li>
	<li>Payment by SMS</li>
</ul>
<p>Secure your activity:</p>
<ul>
	<li>Anti-fraud scoring system</li>
	<li>Transaction Management</li>
	<li>Litigation support</li>
</ul>
<p>&nbsp;<a href="https://www.klikandpay.com/cgi-bin/inscription.pl?L=en">Open an account</a>&nbsp;or send us an email to <a href="mailto:market@klikandpay.com">market@klikandpay.com </a>
</p>
<p>If you already have a Klik &amp; Pay merchant account, you can directly set it up using our payment plugin Klik &amp; Pay provided in VirtueMart.</p>
<p><img src="http://virtuemart.net/images/klikandpay/klikandpay-snapshot.png" alt="klikandpay screenshot" style="display: block; margin-left: auto; margin-right: auto;" />
</p>
<p>We worked a lot on the new Virtuemart 3.0.2 . The update should be easy. There will be a lot database changes, but they are many, but minor. It will increase the speed of your page noticeable. Bugs fixed:</p>
<ul>
	<li>increased consistency of the install.sql and reduced int size for better performance</li>
	<li>extra attachment should now be sent to the shopper and not vendor as intended</li>
	<li>added itemId to products</li>
	<li>fixed "typo" in calculationh.php</li>
	<li>vmJsApi the function addJScript is not anylonger overwriting the attribute "written" if exists already</li>
	<li>set CacheTime to minutes</li>
	<li>fixed javascript for tinyMce 4, removed the doubled // of the flag link</li>
	<li>fixed typo in plugin.php</li>
	<li>Better use of loading the xml parameter into the JForm (thx Kainhofer)</li>
	<li>enhanced modals (thx Spyros)</li>
	<li>sortSearchListQuery or products model uses getCurrentUser now to ensure that the correct id is set (Thank you Stan Scholtz)</li>
	<li>removed a lot deprecated getSetError(s)</li>
	<li>vmTable is not derived anylonger from JTable, derived functions added</li>
	<li>optimised joomla tables for fullinstaller</li>
	<li>Some more adjustments of VmTable for J3, using dummy interfaces</li>
	<li>fixed spec file font problem, if no spec files there</li>
	<li>users allowed to adminstrate shoppers can now also select shoppers in the cart</li>
	<li>removed old comments, vmdebugs,...</li>
	<li>changed all &lt;span class="product-field-display"&gt; to &lt;div class="product-field-display"&gt;</li>
</ul>
<div>
	<p><a href="http://dev.virtuemart.net/attachments/download/887/com_virtuemart.3.0.2_extract_first.zip">DOWNLOAD VM3 NOW<br /> VirtueMart 3 component (core and AIO)</a>
	</p>
</div>
<p>We still support vm2.6 and there is also no EOL set yet. But new features will be found in VM3. The update to vm2.6.14 should be very user friendly. Bugs fixed:</p>
<ul>
	<li>jQuery fix for automatically redirection to payment providers</li>
	<li>PDF works with diskcache now, less problems with images in invoice</li>
	<li>Authorize.net works now also with extra ST address</li>
	<li>small fixes, enhancements, removed typos for different payments</li>
</ul>
<div>
	<p><a href="http://dev.virtuemart.net/attachments/download/879/com_virtuemart.2.6.14_extract_first.zip">DOWNLOAD VM2.6.14<br /> VirtueMart 2 component (core and AIO)</a>
	</p>
</div></div>";}}}