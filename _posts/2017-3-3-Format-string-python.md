---
layout : post
title : Format String in Python
---
Cũng đã khá lâu kể từ ngày dấn thân vào chơi Web với mơ ước trong năm 2017 có thể kiếm một bug bounty nào đó, dù là 10 Trump hay là 5000 Trump, nói thế thôi, đó cũng là một động lực để cố gắng mỗi ngày ngồi trước máy làm việc, vì đồng tiền trang trải cuộc sống trước mặt, cũng vì ước mơ vươn lên trong cuộc sống =]] (ngôn lù vãi lúa)
"CTF chưa bao giờ làm tôi mệt mỏi" - yeuchimse
Đúng vậy, CTF mang lại cho tôi nhiều kiến thức, nhiều cái mới mới mà tôi cần update liên tục, cũng từ đó tôi có thể áp dụng trong công việc cũng như để góp nhặt từng viên đá để bước vào thế giới bug bounty.
Với giải PCTF 2017 lần này tôi gặp một kiến thức cần phải ghi lại vào blog ngay đó chính là Format string in Python. Trước nay, ta biết đến Format string trong explit software bởi input khiến software làm việc sai theo logic của người lập trình, từ đó đưa ra các output theo ý của pwner (hơi lủng củng ý :D), nhưng ở đây Format String lại là một dạng khác. Nó là một "tính năng" của ngôn ngữ lập trình, đại loại là nó xuất ra-gán giá trị của biến đó. Ví dụ:
{% highlight python linenos %}>>>'{0},{1},{2}'.format('a','b','c')
'a, b, c'
>>> '{}, {}, {}'.format('a', 'b', 'c')
'a, b, c'
>>> '{2}, {1}, {0}'.format('a', 'b', 'c')
'c, b, a'
{% endhighlight %}
Như vậy ta có thể "truy cập" giá trị dựa vào vị trí của biến :)) và có thể lấy được các thuộc tính của biến đó. Tương tự như vậy, trong bài Pykemon sau khi bắt được một pet thì inject F0rm4t 5trin9 vào như sau:
