# Oğuzhan Taşımaz 170201041 17.01.2021

# Not Alma Uygulamasi

Not Alma modülü kullanıcının not tutmasına imkan veren bir modülüdür. 
http://portal.kouosl/admin/notetaking adresi ile erişilen backend kısmından giriş yapılarak not tutma ve düzenleme imkanı sunan modül aynı zamanda, 
http://portal.kouosl/notetaking adresiyle normal kullanıcılara sunulan arayüz ile herkese açık olarak eklenen notları görsel olarak göstermektedir.

# İçindekiler

- Kurulum
  * Vagrant Kurulumu
  * Composer ve Packagist
  * Konfigürasyon
  * Migrations
- Kullanım
  * Notları Görüntüleme ve Düzenleme
  * Not Ekleme
  * Anahtar Kelime Ekleme
  * Flash Mesajlar
  * Anahtar Kelimeler ile Arama
  * Admin Kullanıcısı 
  * Admin Kullanıcı Ekranı
  * Front End

# Kurulum

## Vagrant Kurulumu

Bu modülün kullanılabilmesi için daha önceden https://github.com/kouosl/portal adresinde belirtilen kurulum talimatları ile yerel makinanın kurulmuş olması ve ilgili sitelere

    Frontend URL: http://portal.kouosl
    Backend URL: http://portal.kouosl/admin
    Api URL: http://portal.kouosl/api

erişilebiliyor olması gerekmektedir.

## Composer ve Packagist

Sonrasında modül composer ile **packagist** üzerinden indirilebilir ve projeye eklenebilir.

Bunun için öncelikle projenin composer.json dosyasının düzenlenmesi gereklidir
composer.json dosyasının require bölümüne aşağıdaki gibi modül ismi eklenmelidir.
```php
"require": {
...
"oguzh/portal-notetaking":"dev-master"
...
},
```

Bu işlemden sonra modül kouosl klasörüne taşınmalıdır. Packagist üzerinden kouosl alan adı daha önceden alındığı ve gönderme izni olmadığı için proje update yapıldıktan sonra vendor/oguzh klasörü altında oluşacaktır. Bunun önüne geçmek için aşağıdaki scripti composer.json dosyasına eklememiz gerekmektedir.

```php
"scripts": {

"post-update-cmd": [
"if [ -d 'vendor/kouosl' ]; then cp -r vendor/oguzh/portal-notetaking vendor/kouosl/; else mkdir vendor/kouosl/ && cp -r vendor/oguzh/portal-notetaking vendor/kouosl/; fi",
"rm -r vendor/oguzh"
]

}
```

Bu sayede modülümüz vendor/kouosl  altına taşınanacaktır.

Düzenlemeleri tamamladıktan sonra 

	vagrant ssh

Komutu ile sanal bilgisayara bağlanıp, projenin olduğu klasöre gitmemiz ve composer ile projenin gerekli paketleri indirip yüklememiz gerekmektedir. Bunun için terminalde :

	cd /var/www/portal
	composer update

Komutları girilmelidir.

## Konfigürasyon
Sonrasında projenin config dosyaları içerisinde modülün tanımlanması gerekmektedir. Bunun için :

	/var/www/portal/console/backend/main.php
	/var/www/portal/console/frontend/main.php

Dosyaları içerisine  aşağıdaki kod eklenmelidir.
```php
'modules' => [
...

'notetaking' => [
'class' => 'kouosl\notetaking\Module',
],

...
],

```
## Migrations

Son olarak  migration kullanılarak modül için gerekli tablolar oluşturulur. Bunun için sanal makineye ssh ile bağlandıktan sonra projenin bulunduğu klasöre gidilmelidir ve yii migrate betiği aşağıda gösterildiği şekilde çalıştırılmalıdır.

	php yii migrate --migrationPath=/var/www/portal/vendor/kouosl/portal-notetaking/migrations


# Kullanım

Portal içerisinde giriş yaptıktan sonra 
	
	http://portal.kouosl/admin/notetaking/ 

Adresi ile modülün backend kısmının giriş sayfası açılmaktadır.

Kullanıcı **Go to notes** butonunu kullanarak, notlarını görebileceği ve düzenleyebileceği sayfaya geçebilmektedir.

## Notları Görüntüleme ve Düzenleme
Bu ekranda kullanıcı notlar içerisinden arama yapabilme, notu görüntüleme,düzenleme ve silme işlemleri yapabilmektedir. 

```php
['class' => 'yii\grid\ActionColumn',
'template' => '{view} {update} {delete} {addkey}',
'buttons' => [
'addkey' => function ($url, $model) {
return Html::a('<span class="glyphicon glyphicon-tag"></span>', $url, [
'title' => Module::t('notetaking', 'Keywords'),
]);
}]],
```
## Not Ekleme

Kullanıcı Not Ekle butonu ile not ekleme ekranına erişmektedir. Kullanıcı notu public veya private ekleyebilmektedir. Public eklenen notlar frontend kısmında tüm kullanıcılara açık bir şekilde gösterilmektedir.

## Anahtar Kelime Ekleme

Kullanıcı bu ekran üzerinden notuna anahtar kelime ekleme ve silme işlemlerini yapabilmektedir.

## Flash Mesajlar

Kullanıcı yaptığı ekleme ve çıkarma işlemlerinden sonra **flash mesajlar** ile bilgilendirilmektedir.
```php
Yii::$app->session->setFlash('success', Module::t('notetaking', 'Keyword added successfully!'));
```

## Anahtar Kelimeler ile Arama

Kullanıcı anahtar kelimeler ile arama yapabilmektedir. Ve bulduğu notlar üzerinde düzenleme yapabilmektedir.

## Admin Kullanıcısı (RBAC ve Konsol Betiği)

Modülde **RBAC** sisteminde 'admin' rolü verilmiş kullanıcı tüm notları görebilme ve düzenleyebilme yetkisine sahiptir. Normal kullanıcılar 'user'  rolüne sahiptir ve sadece kendi notlarına erişebilmektedirler.
Bunun için konsoldan çalışan bir konsol betiği bulunmaktadır.

Betiği konsol üzerinden çalıştırabilmek için öncelikle console config dosyası içerisine modülümüzün controller dosyasını eklememiz gerekmektedir. Bunun için: 

	/var/www/portal/console/config/main.php

Dosyasına aşağıdaki kod parçacığı eklenmelidir.

```php
'controllerMap' => [
...
'notetaking' => [
'class' => 'kouosl\notetaking\controllers\console\RbacController',
],
...
],

```

Sonrasında çağırılan betik RBAC sisteminin initial ayarlarını yapmaktadır.
 
RBAC sistemini kullanabilmek için  authManager konfigürasyonunu yapmamız gerekir. Bunun için : 


	/var/www/portal/console/config/main.php
	/var/www/portal/console/backend/main.php


Dosyalarına aşağıdaki kod parçacığının eklenmesi gereklidir.


```php
...
, 'authManager' => [

'class' => 'yii\rbac\PhpManager',

'itemFile' => '/var/www/portal/vendor/kouosl/portal-notetaking/rbac/items.php',

'assignmentFile' => '/var/www/portal/vendor/kouosl/portal-notetaking/rbac/assignments.php',

'ruleFile' => '/var/www/portal/vendor/kouosl/portal-notetaking/rules.php',

],
...
```

RBAC ilişkilendirme dosyaları modül içerisinde rbac klasöründe tutulmaktadır.


Controller içerisinden tanımlanan aksiyonlar **Yii::$app->user->can()** metotu ile kontrol edilerek çağırılmaktadır.
Örneğin admin kullanıcısı seeAllNotes iznine sahiptir ve 

```php
...if (Yii::$app->user->can('seeAllNotes'))... 
```

bloku içerisinde tüm notları görme ve düzenlebilir.


## Admin Kullanıcı Ekranı

Admin rolüne atanmış bir kullanıcı tüm notları görebilmekte ve düzenleyebilmektedir.

## Arayuz

Modülün arayüz kısmına aşağıda adres üzerinden erişilmektedir. Notlar görünecek şekilde bootstrap, css ve html düzenlemesi yapılmıştır.
	
	http://portal.kouosl/notetaking/ 
