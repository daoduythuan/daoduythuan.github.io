---
layout : post
title : Format String in Python
---
Cũng đã khá lâu kể từ ngày dấn thân vào chơi Web với mơ ước trong năm 2017 có thể kiếm một bug bounty nào đó, dù là 10 Trump hay là 5000 Trump, nói thế thôi, đó cũng là một động lực để cố gắng mỗi ngày ngồi trước máy làm việc, vì đồng tiền trang trải cuộc sống trước mặt, cũng vì ước mơ vươn lên trong cuộc sống =]] (ngôn lù vãi lúa)<br>
"CTF chưa bao giờ làm tôi mệt mỏi" - yeuchimse<br>
Đúng vậy, CTF mang lại cho tôi nhiều kiến thức, nhiều cái mới mới mà tôi cần update liên tục, cũng từ đó tôi có thể áp dụng trong công việc cũng như để góp nhặt từng viên đá để bước vào thế giới bug bounty.<br>
Với giải PCTF 2017 lần này tôi gặp một kiến thức cần phải ghi lại vào blog ngay đó chính là Format string in Python. Trước nay, ta biết đến Format string trong explit software bởi input khiến software làm việc sai theo logic của người lập trình, từ đó đưa ra các output theo ý của pwner (hơi lủng củng ý :D), nhưng ở đây Format String lại là một dạng khác. Nó là một "tính năng" của ngôn ngữ lập trình, đại loại là nó xuất ra-gán giá trị của biến đó. Ví dụ:<br>
{% highlight python linenos %}
>>>'{0},{1},{2}'.format('a','b','c')
'a, b, c'
>>> '{}, {}, {}'.format('a', 'b', 'c')
'a, b, c'
>>> '{2}, {1}, {0}'.format('a', 'b', 'c')
'c, b, a'
{% endhighlight %}
Như vậy ta có thể "truy cập" giá trị dựa vào vị trí của biến :)) và có thể lấy được các thuộc tính của biến đó. Tương tự như vậy, trong bài Pykemon sau khi bắt được một pet thì inject F0rm4t 5trin9 vào như sau:

{% highlight java linenos %}
name=pikachu&name={0.__class__.pykemon}
{% endhighlight %}

Vì sao lại inject như vậy?<br>
Vì:<br>
1 . Đọc source code thì ta thấy tại line 19 như sau<br>

{% highlight python linenos %}return "Successfully renamed to:\n" + new_name.format(p)
{% endhighlight %}

Ok, như vậy là đã gọi format()<br>
2 . Có 1 dict khai báo các pokemon:
{% highlight python linenos %}pykemon = [
            [100, 'Pydiot', 'Pydiot','images/pydiot.png', 'Pydiot is an avian Pykamon with large wings, sharp talons, and a short, hooked beak'],
            [90, 'Pytata', 'Pytata', 'images/pytata.png', 'Pytata is cautious in the extreme. Even while it is asleep, it constantly listens by moving its ears around.'],
            [80, 'Pyliwag', 'Pyliwag', 'images/pyliwag.png', 'Pyliwag resembles a blue, spherical tadpole. It has large eyes and pink lips.'],
            [70, 'Pyrasect', 'Pyrasect', 'images/pyrasect.png','Pyrasect is known to infest large trees en masse and drain nutrients from the lower trunk and roots.'],
            [60, 'Pyduck', 'Pyduck', 'images/pyduck.png','Pyduck is a yellow Pykamon that resembles a duck or bipedal platypus'],
            [50, 'Pygglipuff', 'Pygglipuff', 'images/pygglipuff.png','When this Pykamon sings, it never pauses to breathe.'],
            [40, 'Pykachu', 'Pykachu', 'images/pykachu.png','This Pykamon has electricity-storing pouches on its cheeks. These appear to become electrically charged during the night while Pykachu sleeps.'],
            [30, 'Pyrigon', 'Pyrigon', 'images/pyrigon.png','Pyrigon is capable of reverting itself entirely back to program data and entering cyberspace.'],
            [20, 'Pyrodactyl', 'Pyrodactyl', 'images/pyrodactyl.png','Pyrodactyl is a Pykamon from the age of dinosaurs'],
            [10, 'Pytwo', 'Pytwo', 'images/pytwo.png','Pytwo is a Pykamon created by genetic manipulation'],
            [0, 'FLAG', 'FLAG','images/flag.png', 'PCTF{XXXXX}']
            ]{% endhighlight %}
Như vậy đã rõ, mục đích cuối cùng của chúng ta là lợi dụng format string để leak flag trong dict pykemon.
Một cách khai thác thật tuyệt vời và sáng tạo. Một lần nữa, tư duy lập trình được đặt lên hàng đâu.<br>
Thời gian bài viết xuất hiện là ngày 3-3, tuy nhiên tôi chẳng nhớ là ngày nào nên để như vậy :v
