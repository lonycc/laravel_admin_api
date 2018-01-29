# laravel5.5 后台管理


## 启动步骤

> 1 先clone本项目：git clone https://github.com/tonyxyl/laravel_admin_api.git

> 2 安装PHP依赖库：composer install

> 3 修改.env数据库配置信息

> 4 执行迁移命令： php artisan migrate

> 5 执行数据填充： php artisan db:seed --class=PermissionSeeder

> 6 启动服务： php artisan serve


## 注意

> 添加操作管理的数据的时候，命名空间、类名、方法名请根据实际情况添加，不要添加不存在的命名空间、类，否则程序会报错.
当添加不存在的命名空间、类名、方法名的时候，程序在生成URL的时候会提示找不到相应的类


## 开始

浏览器打开http://localhost:8000/  进入登录界面：

用户角色：用户名/密码

管理员账号：admin/123456

## api调用测试

**注册用户**

`curl -X POST -F "name=test" -F "email=test@test.com" -F "password=test1234" "http://localhost:8000/api/auth/signup"`

返回结果

```
{
  "code":200,
  "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9zaWdudXAiLCJpYXQiOjE1MTYxNTM3MDcsImV4cCI6MTUxNjE1NzMwNywibmJmIjoxNTE2MTUzNzA3LCJqdGkiOiJkOUQ5N250MzNOVWFvSXM1In0.3GIsMuQhRXXwO4vIn7kLR9BhW3kcbNxZw0vUGgqvEDw"
}
```

**登录**

`curl -X POST -F "email=test@test.com" -F "password=test1234" "http://localhost:8000/api/auth/login"`

返回结果

```
{
  "code":200,
  "message":"token生成成功",
  "data":{
    "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTUxNjE1Mzc3NCwiZXhwIjoxNTE2MTU3Mzc0LCJuYmYiOjE1MTYxNTM3NzQsImp0aSI6IlV0dnhuaVFRc3M4bjFUaDEifQ.lNguCrjUvukdr4lQekxvnJxySX6rn0ab-g7RpVeiL10"
  }
}
```

**请求权限数据**

`curl -X GET -H "Authorization: Bearer 上面获取到的token" "http://localhost:8000/api/auth/user"`

返回结果

```
{
  "code": 200,
  "message": "已授权的用户",
  "data": {
    "id": 1,
    "email": "test@test.com",
    "name": "test",
    "created_at": null,
    "updated_at": null
  }
}
```

**刷新授权**

`curl -X PATCH -H "Authorization: Bearer 上面获取到的token" "http://localhost:8000/api/auth/refresh"`

返回结果

```
{
  "code": 200,
  "message": "token刷新成功",
  "data": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYXV0aC9yZWZyZXNoIiwiaWF0IjoxNTE2MTUzNzc0LCJleHAiOjE1MTYxNTc4NzAsIm5iZiI6MTUxNjE1NDI3MCwianRpIjoiSHNYclNGc1h1eGdUOVVmdCJ9.7d-kK_Bnva9W5U2dzBNVhvFaGcLbY7Ikqm891uqiXEE"
  }
}
```

**删除授权**

`curl -X DELETE "Authorization: Bearer 上面获取到的token" "http://localhost:8000/api/auth/invalidate"`

返回结果

```
{
  "code": 200,
  "message": "token删除成功"
}
```

## 后台截图

![登录页面](./screenshot/1.png)

![后台首页](./screenshot/2.png)

![用户管理](./screenshot/3.png)

![角色管理](./screenshot/4.png)

![操作管理](./screenshot/5.png)


## 常用的第三方服务包

**图形验证码**

`composer require mews/captcha`

`Mews\Captcha\CaptchaServiceProvider::class,`

`'Captcha' => Mews\Captcha\Facades\Captcha::class,`

`php artisan vendor:publish`  #生成config/captcha.php

**图片处理扩展包**

`composer require intervention/image`

`Intervention\Image\ImageServiceProvider::class,`

`'Image' => Intervention\Image\Facades\Image::class,`

`php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"`  #生成config/image.php

// 修改指定图片的大小

`$img = Image::make('images/avatar.jpg')->resize(200, 200);`

// 插入水印, 水印位置在原图片的右下角, 距离下边距 10 像素, 距离右边距 15 像素

`$img->insert('images/watermark.png', 'bottom-right', 15, 10);`

// 将处理后的图片重新保存到其他路径

`$img->save('images/new_avatar.jpg');`

// 上面的逻辑可以通过链式表达式搞定

`$img = Image::make('images/avatar.jpg')->resize(200, 200)->insert('images/new_avatar.jpg', 'bottom-right', 15, 10);`

**excel服务**

`composer require "maatwebsite/excel:~2.1.0"`

`Maatwebsite\Excel\ExcelServiceProvider::class,`

`'Excel' => Maatwebsite\Excel\Facades\Excel::class,`

`php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"`  #生成config/excel.php

**pdf 服务**

`composer require barryvdh/laravel-dompdf`

`Barryvdh\DomPDF\ServiceProvider::class,`

`'PDF' => Barryvdh\DomPDF\Facade::class,`

`php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"`  #生成config/dompdf.php

**html过滤包**

`composer require mews/purifier`

`Mews\Purifier\PurifierServiceProvider::class,`

`'Purifier' => Mews\Purifier\Facades\Purifier::class,`

`php artisan vendor:publish --provider="Mews\Purifier\PurifierServiceProvider"`  #生成config/purifier.php

`clean(Input::get('inputname'));`

`Purifier::clean(Input::get('inputname'));`

**浏览器跨域**

`composer require barryvdh/laravel-cors`

`Barryvdh\Cors\ServiceProvider::class,`

`php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"`  #生成config/cors.php

**根据ip获取地址位置**

`composer require "zhuzhichao/ip-location-zh"`

`'Ip'  => 'Zhuzhichao\IpLocationZh\Ip::class,`

`Ip::find('171.12.10.156')` or `Ip::find(Request::getClientIp())`
