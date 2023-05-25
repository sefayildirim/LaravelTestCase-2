# Laravel Relationships Test Case

Aşağıda ERD diyagramı verilecek olan sistemi oluşturmanız ve web arayüzüyle birlikte tamamlamanızı beklemekteyiz.
ERD diyagramına bağlı kalmakla birlikte, kafanızda oluşturacağınız senaryoya göre daha fazlasını üstüne koymanız ve ek 
tablolar oluşturmanız beklenmektedir.

![ERD Diagram](https://i.hizliresim.com/4vpqjzn.jpg)

## Back-end:

- **Model İlişkileri**: Proje için tanımlanan veritabanı tabloları arasındaki ilişkileri model sınıfları üzerinde tanımlayın. Bu, Eloquent ORM ile yapılabilir. İlişkileri belirlemek için `hasOne`, `hasMany`, `belongsTo`, `belongsToMany` gibi ilişki metotlarını kullanmanız gerekmektedir.

- **Laravel ORM**: Laravel'in ORM özelliklerini kullanarak veritabanı işlemlerini gerçekleştirin. Model sınıflarınız üzerinde, veritabanı ile ilgili CRUD (oluşturma, okuma, güncelleme, silme) işlemlerini yapacak yöntemleri (methodlar) tanımlamalısınız.

- **Laravel UI / Jetstream**: Laravel UI veya Jetstream gibi paketleri kullanarak kullanıcı oturumu açma işlemini gerçekleştirin. Kullanıcıların e-posta doğrulaması yapmasını sağlayan bir oturum açma yöntemi oluşturun. Mailtrap gibi bir hizmeti kullanarak e-posta doğrulama testini yapabilirsiniz.

- **Middleware**: Middleware kullanarak, e-posta doğrulaması yapılmamış veya hesapları etkinleştirilmemiş kullanıcıların hiçbir işlem yapamamasını sağlayın. Bu, kullanıcıların sisteme giriş yapmalarını veya diğer işlemleri gerçekleştirmelerini engelleyecektir.

- **Kullanıcı ve Yönetici Paneli**: Hem kullanıcılar hem de yöneticiler (admin) için ayrı panel sayfaları oluşturun. Yönetici paneli, `user_detail` tablosundaki bilgilere dayanarak kullanıcıları yönetebilmelidir.

- **Veritabanı Seeding**: Veritabanına, ön yüzde görüntülenebilecek kadar örnek veri eklemek için Database Seeder kullanın. Bu, projenizin test edilmesi ve veri görüntüleme işlemlerinin gerçekleştirilmesi için faydalı olacaktır.

## Front-end:

### Admin Paneli:

- Tüm satıcıları, müşterileri, ürünleri, raporları, ödemeleri ve siparişleri görüntüleyebilecek ekranlar oluşturun.
- Bootstrap DataTables kullanın, ancak Laravel'de kendi sayfalama görünümünüzü oluşturmak için custom pagination view'ınızı yayınlayın. DataTables'da "showing" kısmını devre dışı bırakın ve 25-50 arasında bir değeri seçmek için kullanılabilen bir buton ekleyin.

### Kullanıcı Paneli (Müşteri - Satıcı):

- Kullanıcılar, kendileriyle ilişkili siparişleri, raporları ve ödemeleri görüntüleyebilmelidir.
- Oturum açmış kullanıcıların diğer endpoint'lere erişimini engellemek için Middleware'i doğru bir şekilde yapılandırın.

## Bonus:

- API rotası dosyasına bir "resource" yapısı oluşturun ve Postman gibi bir araçla bu rotalardaki yöntemleri test edin.
- CRUD işlemleri tamamlanmalıdır. Kodunuzu anlaşılır hale getirmek için yorum satırları eklemeyi unutmayın.
