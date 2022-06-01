Ecommrece

# User Website

prouct display
filter
product review
product like
cart system
checkout

# Admin website

Auth x
Supplier
Product , Brand , Color ,Category Management
prouct add transaction
product remove tran
order
order Chart

# users

id name email phone password address role('admin','user')

# supplier

id name image description(null);

# Brand

id slug name

# Category

id slug name

# Color

id slug name

# product

supplier_id brand_id category_id name image description total_quantity sell_price buy_price view_count like_count

# product_review

user_id product_id review

# product_add_transaction

product_id supplier_id total_quantity buy_price buy_date description(null)

# product_remove_transaction

product_id total_quantity description(null)

# cart

user_id product_id total_quantity

# order

user_id product_id total_quantity order_date order_status('pending','success','reject')

Website
Product
Product Filter
Login Register Auth
Cart
Dashboard (order list)

Admin
CRUD (supplier,category,color,brand)
Product
Product Add
Product Remove
Orders
Analysis (Sale,User,Product below 3)

colors
[
{1},{2},{3}
]

selected
[
{1},{2}
]

foreach(colors as c){
foreach(selected as cs){
if(cs->id==c->id){
echo 'selected';
}
}
}







cart
====
id   user id        product id      qty


order_group
=============
id      user_id     status(pending,success,reject)
1       1               pending

order
======
id  order_group_id  user id        product id      qty
1       1           1               1               1
1       1           1               1               1






Product တစ်ခုချင်းစီရဲ့ total price ထုတ် ကြည့်ပါ
Total Qutntiyကို remove လုပ်ပါ



