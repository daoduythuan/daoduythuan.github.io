Hi, it's me again :D
Last week, I found a XSS vulnerability on *.myshopify.com. You can register a trial account and add a new product. 
At the product's title, you can inject a javascript and at the admin's taskbar you click the `View` button and it will automatically open a new tab and a XSS popup will alert :P
