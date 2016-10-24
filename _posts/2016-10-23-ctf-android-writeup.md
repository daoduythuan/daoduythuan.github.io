---
layout : post
title : All Ctf Android in 2015
---
Đang trong những tháng ngày nhàn cư vi và hằng đêm những tiếng nói thất thanh vẫn vang lên trong giấc mơ.<br>
-"Trình tuổi --- gì mà đòi vào team này, --- có đâu nhé, đừng có mơ!"<br>
-"[Tim không cần!](https://www.youtube.com/watch?v=7IPWNAiu4n0)"<br>
...<br>
Rồi một buổi trưa hè nắng chói chang, thằng Thành VinGlad pm:<br>
-"Hey loser, jobless!!! Mày làm hết đống chall trên [droidsec](http://www.droidsec.org/wiki/#crack-mes) rồi writeup lại đâu đó cho tao!"<br>
Tôi xem qua một tí mới hiểu thì ra trang này tổng hợp hết lại những challenge về mobile trong các năm vừa rồi. Cũng đang rảnh rỗi nên quyết định làm lại với mục đích ôn lại kiến thức, bài vở mà thầy cô dạy ở trường cũng như hệ thống lại kiến thức cho bản thân :v<br>
Vì số giải nhiều quá nên chỉ làm các challenge trong năm 2015, còn các giải trong năm 2016 (có chall làm ra, chall không) thì khi nào nó tổng hợp lại rồi làm lại vì nhiều quá nhớ không hết :D<br>
Ok! Không chém gió luyên thuyên nữa, trong lần đầu viết writeup này sẽ kể lại quá trình ngồi chơi các giải cũ như 0ctf, Ali ctf, Cyber Security, Poli, Pragyan <br>
<br>
<br>

# Cyber Security <br>
## Simple <br>
<p>
Challenge đưa 1 file apk NvisoVault, chạy trên emulator thì thấy có nhiều chuỗi dài.<br>
Thử dùng DDMS để bắt process và xuất log file, ta xem các strings có trong đó như thế nào<br> </p>
![_config.yml]({{ site.baseurl }}/images/nvisovault.PNG)
<br>
<code>Ồ! Tui_Iu_Gấu_Chút</code> <br>
Chắc là flag đây rồi, ez như description của chall :v <br>
Giải còn 1 bài nữa mà không có file apk nên quỳ, 1 bài của 0ctf cũng tương tự như vậy, chỉ khác flag :D <br>
<br>


# 0ctf <br>
##vezel<br>
<p>
Tiếp tục sử dụng DDMS để coi log nhưng không có gì đặc biệt nên bắt đầu decompile để xem source. Trong MainActivity ta chú ý tới getCrc() và getSig()<br>

{% highlight java linenos %}
private String getCrc()
  {
    try
    {
      long l = new ZipFile(getApplicationContext().getPackageCodePath()).getEntry("classes.dex").getCrc();
      return String.valueOf(l);
    }
    catch (Exception localException)
    {
      localException.printStackTrace();
    }
    return "";
  }
{% endhighlight %}<br>

Như vậy có thể hiểu getCrc() làm công việc tính toán Crc của classses.dex<br>
Tiếp đến getSig()<br>

{% highlight java linenos %}
private int getSig(String paramString)
  {
    PackageManager localPackageManager = getPackageManager();
    try
    {
      int i = localPackageManager.getPackageInfo(paramString, 64).signatures[0].toCharsString().hashCode();
      return i;
    }
    catch (Exception paramString)
    {
      paramString.printStackTrace();
    }
    return 0;
  }
{% endhighlight %}
<br>
Tại đây thực hiện công việc lấy signature của app rồi sau đó tính sang hashCode hay là tính hashCode rồi tính sang signature (không rành Jav lắm nên đoán như vậy :v ) <br>
Ta chú ý tới confirm(), tại đây thực hiện việc tính toán flag - mục tiêu cuối cùng! <br>

{% highlight java linenos %}
  public void confirm(View paramView)
  {
    int i = getSig(getPackageName());
    paramView = getCrc();
    if (("0CTF{" + String.valueOf(i) + paramView + "}").equals(this.et.getText().toString()))
    {
      Toast.makeText(this, "Yes!", 0).show();
      return;
    }
    Toast.makeText(this, "0ops!", 0).show();
  }
{% endhighlight %}

Như vậy flag sẽ có dạng flag = 0CTF{hashCode() + Crc} <br>
Crc tính được rồi, sử dụng Python ta tính được bằng cách này: <br>

{% highlight python linenos %}
python -c "print __import__('binascii').crc32(__import__('sys').stdin.read())" < classes.dex
{% endhighlight %}

Còn signature hashCode tính sao đây? Gần 3 tiếng miệt mài Google thì gặp ngay trang [này](http://androidcracking.blogspot.com.au/2010/12/getting-apk-signature-outside-of.html) có code 1 [tool](https://github.com/daoduythuan/ida-68/blob/master/Main.java) để lấy sig, liền clone về xem thử mặt mũi ra sao<br>
![_config.yml]({{ site.baseurl }}/images/vezel.PNG)<br>
Tới đây thì cũng ra flag rồi!
</p>
<br>
<br>

#Poli<br>
#crack-me-if-you-can<br>
Chall này yêu cầu nhập vào một chuỗi, nếu đúng sẽ báo đúng, nếu sai sẽ báo sai. Ý tưởng ban đầu như mọi khi là decompile và xem trong source có compare với chuỗi nào na ná với flag không.

{% highlight java linenos %}
package it.polictf2015;

import android.app.Activity;
import android.app.LoaderManager.LoaderCallbacks;
import android.content.Context;
import android.content.Loader;
import android.database.Cursor;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity
  extends Activity
  implements LoaderManager.LoaderCallbacks
{
  private EditText a;
  private View b;
  
  private void a()
  {
    EditText localEditText1 = null;
    this.a.setError(null);
    String str = this.a.getText().toString();
    int i = 0;
    if (TextUtils.isEmpty(str))
    {
      this.a.setError(getString(2131492923));
      localEditText1 = this.a;
      i = 1;
    }
    EditText localEditText2 = localEditText1;
    int j = i;
    if (!TextUtils.isEmpty(str))
    {
      localEditText2 = localEditText1;
      j = i;
      if (!a(str))
      {
        this.a.setError(getString(2131492919));
        localEditText2 = this.a;
        j = 1;
      }
    }
    if (j != 0) {
      localEditText2.requestFocus();
    }
  }
  
  private boolean a(Context paramContext, double paramDouble)
  {
    return (paramDouble == 3.41D) || (((TelephonyManager)paramContext.getSystemService("phone")).getSubscriberId().equalsIgnoreCase("310260000000000"));
  }
  
  private boolean a(Context paramContext, int paramInt)
  {
    return (paramInt == 2) || (((TelephonyManager)paramContext.getSystemService("phone")).getNetworkOperatorName().equalsIgnoreCase("android"));
  }
  
  private boolean a(Context paramContext, String paramString)
  {
    paramString.replace("flagging", "flag");
    return ((TelephonyManager)paramContext.getSystemService("phone")).getLine1Number().startsWith("1555521");
  }
  
  private boolean a(Context paramContext, boolean paramBoolean)
  {
    paramContext = ((TelephonyManager)paramContext.getSystemService("phone")).getDeviceId();
    return (paramContext.equalsIgnoreCase("000000000000000")) || (paramContext.equalsIgnoreCase("012345678912345")) || (paramContext.equalsIgnoreCase("e21833235b6eef10"));
  }
  
  private boolean a(String paramString)
  {
    if (paramString.equals(c.a(b.a(b.b(b.c(b.d(b.g(b.h(b.e(b.f(b.i(c.c(c.b(c.d(getString(2131492920))))))))))))))))
    {
      Toast.makeText(getApplicationContext(), getString(2131492924), 1).show();
      return true;
    }
    return false;
  }
  
  public void a(Loader paramLoader, Cursor paramCursor) {}
  
  protected void onCreate(Bundle paramBundle)
  {
    super.onCreate(paramBundle);
    setContentView(2130968599);
    if ((a(getApplicationContext(), 2)) || (a(getApplicationContext(), "flagging{It_cannot_be_easier_than_this}")) || (a(getApplicationContext(), false)) || (a(getApplicationContext(), 2.78D))) {
      Toast.makeText(getApplicationContext(), getString(2131492925), 1).show();
    }
    for (;;)
    {
      this.a = ((EditText)findViewById(2131361877));
      ((Button)findViewById(2131361878)).setOnClickListener(new a(this));
      this.b = findViewById(2131361875);
      return;
      Toast.makeText(getApplicationContext(), getString(2131492922), 1).show();
    }
  }
  
  public Loader onCreateLoader(int paramInt, Bundle paramBundle)
  {
    return null;
  }
  
  public void onLoaderReset(Loader paramLoader) {}
}
{% endhighlight %}<br>

Ta chú ý rằng có chuỗi <code>flagging{It_cannot_be_easier_than_this}</code> nhưng nhập vào thì không đúng. Tìm mấy chỗ compare thì ta thấy có điểm chẳng hạn như là <br>

{% highlight java linenos %}
private boolean a(Context paramContext, boolean paramBoolean)
  {
    paramContext = ((TelephonyManager)paramContext.getSystemService("phone")).getDeviceId();
    return (paramContext.equalsIgnoreCase("000000000000000")) || (paramContext.equalsIgnoreCase("012345678912345")) || (paramContext.equalsIgnoreCase("e21833235b6eef10"));
  }
{% endhighlight %}<br>

có <code>equalsIgnoreCase</code> hoặc <br>

{% highlight java linenos %}
private boolean a(String paramString)
  {
    if (paramString.equals(c.a(b.a(b.b(b.c(b.d(b.g(b.h(b.e(b.f(b.i(c.c(c.b(c.d(getString(2131492920))))))))))))))))
    {
      Toast.makeText(getApplicationContext(), getString(2131492924), 1).show();
      return true;
    }
    return false;
  }
  {% endhighlight %}
<p>
Đù! Obfuscate vãi đạn, vô các class a,b,c coi thử ở đó làm gì. Ta chú ý các class b,c thực hiện công việc replace các kí tự trong 1 chuỗi nào đó nhưng chuỗi đó là chuỗi nào? Tìm kiếm trong các file của apk cũng không thấy gì khả quan. Đang cùng đường bế tắc, nhìn qua nhìn lại cái taskbar thì nảy ra ý tưởng load vô </p> [IDA](https://www.facebook.com/photo.php?fbid=686146984870782&set=a.149719195180233.34248.100004264603739&type=3&theater) debug, nhưng chơi Dalvik code thì thốn thiệt. Thế là vừa dựa theo source code Java vừa bám theo code Dalvik ta đặt bp tại nhiều chỗ có compare. Đặc biệt chú ý tới chỗ obfuscate</p> <br>
![_config.yml]({{ site.baseurl }}/images/crackmeifyoucan.PNG)
<p>
Sau nhiều lần replace thì chuỗi cuối cùng sẽ trả về v4 và được compare với v1, do đó khi debug lên ta sẽ biết giá trị của nó như thế nào
</p>

