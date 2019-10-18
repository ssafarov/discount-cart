# Shopping cart with discount constructor

### Introduction
A flexible coupon system that allows for different discount strategies without requiring major rewrites in the future.

A coupon may have many RULES (conditions to be met) and many DISCOUNT TYPES (benefits). If one rule is not met, the system must reject the coupon. And only one coupon may be applied at any given time.


# Getting started
### Requirements
* MySQL server 5.6+
* PHP 7.x
* NPM
* Composer

### Installation
Before run the application you will need to make several preparations steps.
* Goto application folder
* Install packages by runing the following commands:
```bash
composer install
npm install
npm run dev
```
or 
```bash
npm run dev prod
```
if you want to have minified css and js files 

* Create database
* Rename **.env.sample** file into **.env** file and set the correct database name, database user and database user password  
* Run the database migrations and seeds:
```bash
php artisan migrate --seed
```
* Finalize laravel application preparation:
```bash
composer dump-autoload
```
* Run web server:
```bash
php artisan serve
```
You will get console notification about running server: 
```
> Laravel development server started: <http://127.0.0.1:8000>
```
Now you can access the application in browser using the URL [http://127.0.0.1:8000](http://127.0.0.1:8000) 
###Database schema and ORM models
The backend part written with Laravel framework, so it using MVC to handle entire process. All logic are stored in controller,
ORM models keeping only relations and dealing with DB to store data. Views are using for coupon constructor app which is traditional.

Based on logic coupon consist of 3 models: Coupon, Discount, Rule. All relations between models defined as model properties.
Coupon model has two has-many relations to discount and rule. Both discount and rule models has a belongs-to relation to coupon model.
 
On a database layer it represented by the 3 tables: coupons, discounts, rules.
#####Coupons table
Has the following fields:
* id - Primary key;
* uuid - Unique field to cover and hide real ID in table from the Frontend;
* title - coupon name/code;
* description - short coupon description;
* laravel timestamps fields to track creation and update date time;
* laravel soft delete field to track coupon deletion but keep it in database;

#####Discounts table
Has the following fields:
* id - Primary key;
* coupon_id - Foreign key for One-to-Many relation representation, as each discount belongs to coupon;
* type - type of the discount. Flag strings which will tell controller about discount logic: fixed or percent in current case.
* condition - How this discount will be applied. Flag strings which will tell controller about discount logic: should we select discount or apply both.
* value - amount of discount to be applied.
* laravel timestamps fields to track creation and update date time;
* laravel soft delete field to track coupon deletion but keep it in database;

#####Rules table
Has the following fields:
* id - Primary key;
* coupon_id - Foreign key for One-to-Many relation representation, as each rule belongs to coupon;
* type - type of the rule. Flag strings which will tell controller about coupon rules logic: single or additional logical operation.
* trigger - Cart object which will trigger the rule: items amount or total summ. 
* triggerCondition - How this rule will be applied. Flag strings which will tell controller about rule logic, how the cart object should be compared with trigger value.
* triggerValue - trigger threshold value.
* laravel timestamps fields to track creation and update date time;
* laravel soft delete field to track coupon deletion but keep it in database;

###Business logic
All coupon application logic implemented in the **ShoppingCartController**. It accept the cart state and coupon code/title and return adjusted card total and/or messages.
There is no any kind of coupon related logic in the Frontend for the safety reasons.  

**CouponController** using for Coupon Constructor CRUD operations. 

#Working with application
##Coupon constructor
Coupon constructor can be reach via top menu by clicking **Coupon constructor (Laravel CRUD there)** link.
You'll see the coupons list which are already exist in the system. You can delete or edit any of them.
###Create new coupon
Click the button **New coupon** on the top of Coupons page. **Add a new coupon** form will appears.
Each coupon has its title (code), description, which is best place to put brief rules description and limitations, 
discount scheme, rules.  

In this version amount of discounts and rules are limited. 

Each coupon can has up to 3 discounts which can be applied together or individually.  
Also coupon can has up to 5 rules which will be used to check if coupon applicable for checking conditions.
```
Each coupon should has at least one basic discount. 
Each coupon should has at least one (first) rule.            
```
 
####Coupon discount shema
Discount can be on of the following type: Fixed amount or Percent amount of Cart total, it can be selected from the dropdown list for each discount.
The discount value will either amount of $ in case of fixed amount type or percent in other case. 
```
So don't set 0.20 or such kind values for percents. 
System will calculate it accordinly. 
For example: value 20 will be either fixed $20 discount or 20% from cart total            
```
Last field of discount is the **condition**. This allows to the system either select appropriate discount from a several options 
or combine them all to apply combined discount with fixed amount plus percentage.  

####Coupon rules schema
The rule system is based on the following logic: we have first rule and several additional rules which will be checked 
one by one with respect to logical operations to determine can this coupon be applied to  given cart state or not.

Each rule has a **trigger** field which operates like a reference point for validation, it determine the cart "**object**"
for validation it can de either **cart items amount** or **cart total summ**. You can select it from a dropdown list.
Next field is the **trigger condition** wich will define logical operation between **trigger object** and **trigger value**
**Trigger value** is the last rule option, it contains kind of **threshold** which is either amount of the cart items or cart total summ.

All rules from the second has an additional option **Rule type** which defines the logical operation for rules application checks.
So you can create pretty complicated coupons which can be applied only if **Rule1 or (Rule2 or Rule3)** will pass for given cart state.

##Shop (product list)                                                                      
This is react application to demonstrate of the coupon constructor logic. It uses api request to coupon constructor 
backend and receive only adjusted cart amount and/or status messages. There is no coupon logic on a frontend part.
The shop has a set of predefined products which can be added to the cart by clicking "**Add to cart**" button. 
After you've added several products to the cart you can click the cart icon on top rigth of the page and cart will appears.

Now you can type any **coupon title** and hit **apply coupon** button. You'll see adjusted cart total and/or some status
messages after some interactions between FE and BE parts.

### Conclusion
Hope you'll like this realization.

### License
MIT: [http://mit-license.org](http://mit-license.org)
