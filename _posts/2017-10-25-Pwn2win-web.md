Pwn2win was held from 20 Oct to 22 Oct 2017, I solved 1 challenge named Criminals. Luckies is all I have to solve this challenge, it like the Big Bang :D
This is my writeup for this challenge (http://200.136.213.109/)

Challenge only has one page and has this form bellow:
![_config.yml]({{ site.baseurl }}/images/1-pwn2win.png)
I played webapp and I tried to test all XSS vulnerable but have no expect result. I played it again, I discovered each input will be selected in DB and send the final result to us. It maybe SQL injection!
I tested each one of input with a single quote and noticed that an error pops up (luckily! I was success with single quote :D ) 
![_config.yml]({{ site.baseurl }}/images/2-pwn2win.png)

Next, I wanna know the dbms is running. As the above pic, I noted "HLQ", it means that The Hibernate Query Language, some kind of a modified SQL with some restrictions. I tried with my payload:
![_config.yml]({{ site.baseurl }}/images/3-pwn2win.png)
OK! Postgres!
After hours googling and read Postgres's doc, I found somethings interested: [Postgres doc](https://www.postgresql.org/message-id/CAHHcreqSb%3Drx9pKCfc5vKL1eD4PU7-3_qEcfiANT4p_2%3DaSTjQ%40mail.gmail.com)
And 
{% highlight python linenos %}
array_upper(xpath ('row', query_to_xml ('select 1 where 69>1', true,  false,'')),1)
{% endhighlight %}
I can execute a subquery like I want. Postgres has a very nice feature, if I cast a string into an integer from a select for example I will generate an error! and the output of that sql query will be printed in the error! I continued google. Finally, I found function build-in pg_ls_dir, it will list all directory and I can generate an error.
![_config.yml]({{ site.baseurl }}/images/4-pwn2win.png)
I can list a file named pg_xlog. Now, I can read other file with payload
{% highlight python linenos %}
array_upper(xpath ('row', query_to_xml ('select cast(pg_ls_dir((SELECT column_name || CHR(44) || table_name FROM information_schema.columns c limit 1 offset 0)) as int)', true,  false,'')),1)
{% endhighlight %}
The output is:
![_config.yml]({{ site.baseurl }}/images/5-pwn2win.png)
I leaked table is flag and column is secrect, I can get flag is: <br>
CTF-BR{bl00dsuck3rs_HQL1njection_pwn2win} <br>
Nice challenge!!! <br>
Now, music for you: [music](https://www.youtube.com/watch?v=s1x1txmfuV8)
