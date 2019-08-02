Hi, it's me again :D
Last week, I found a XSS vulnerability on *.myshopify.com. You can register a trial account and add a new product. <br>
At the product's title, you can inject a javascript and at the admin's taskbar you click the `View` button and it will automatically open a new tab and a XSS popup will alert :P <br>
![_config.yml]({{ site.baseurl }}/images/xss-shopify.png)
Maybe it is a store-xss but Shopify's rule does not accept it :| <br>
![_config.yml]({{ site.baseurl }}/images/camphoto_959030623.jpg) <br>
In my opinion, when a hacker has admin's privilege he can hijack other visitor when they shopping LOL . <br>
Well I don't mind anything about Shopify's rule and I think I can disclosed this vulnerability :D <br>
Yup this is it and happy hacking!!!
