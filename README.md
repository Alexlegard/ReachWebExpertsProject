# About RWEStore

RWEStore is a project I created during my internship with the company Reach Web Experts in 2020. I continued to work on this project ever since, and now I have it on my portfolio website as my professional project to demonstrate my skill in Laravel and creating CMS websites.

It is a restaurant finder application as well as an ecommerce website. Users are able to browse various restaurants for meals. They can place orders, but won't actually be charged for anything as this isn't a real store. Users have profiles, and they can change their avatar, view their favorite restaurants, view other users they are following, and so forth. Restaurants have product offerings, and they can also be commented on by the users.

Restaurants are managed by restaurant owners ("admins"). Restaurant owners can manage their restaurants, dish offerings, their restaurant reviews, view their orders and revenue, and much more. I've also integrated ChartJS so the admin can view their sales at a glance in a nice, readable format.

Above the restaurant owners is the super admin, which is the owner of the website. The super admin has absolute control over the website's content. For instance, they are able to delete restaurants or even users.


## Features List

#### Users

-Register an account (email verification is required)
-Password reset
-Change profile settings (name, email, description, billing & shipping address, avatar)
-Post reviews
-Add items to cart & view cart
-Place and view orders
-Set restaurants as favorites
-Follow other users
-View reviews of users you follow ("Social Feed")


#### Admin / Restaurant Owner

-Create restaurant applications which are unapproved restaurants
-Read, update, and delete restaurants
-Create, read, update, delete dishes for their restaurants
-Create dish options (a way for users to customise certain dishes)
-View recent orders/invoices
-View reviews on their restaurants and delete them
-View profile
-Password reset


#### Super Admin

-Delete restaurants and all related data
-Approve and deny restaurant applications
-View all orders and sales
-Delete reviews
-Delete users and admins
-View profile
-Password reset


## Admin Credentials

#### Admin / Restaurant Owner

Login url: http://127.0.0.1:8000/admin/login

Username: alexlegard3@gmail.com

Password: v11gH,^!w}-H

#### Super Admin

Login url: http://127.0.0.1:8000/superadmin/login

Username: alexlegard3@gmail.com

Password: >UGDdFi?w2ur