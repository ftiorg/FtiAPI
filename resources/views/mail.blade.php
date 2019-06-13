<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$text}}</title>
</head>
<body>
<div style="background:#ececec;width: 100%;padding: 50px 0;text-align:center;">
    <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5;">
        <div style="zoom:1;padding:25px 40px;background:#518bcb; border-bottom:1px solid #467ec3;">
            <h1 style="color:#fff; font-size:25px;line-height:30px; margin:0;"><a href="https://www.isdut.cn"
                                                                                  style="text-decoration: none;color: #FFF;">ISDUTAPI</a>
            </h1>
        </div>
        <div style="padding:35px 40px 30px;">
            <h2 style="font-size:18px;margin:5px 0;">{{$text}}</h2>
            <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0;">{{$desp}}</p>
            <br>
            <div style="font-size:13px;color:#a0a0a0;padding-top:10px">该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。</div>
            <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0;">
                <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;">www.isdut.cn</p>
                <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;"><span
                            style="border-bottom:1px dashed #ccc;" t="5"
                            times=""><?=date( "Y年m月d日 H:i:s", time() )?></span>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>