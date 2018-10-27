# BudHub DB
Welcome to the Database behind the BudHub mobile app.

### Connect to the DB
(From the directory that contains the keypair *.pem file.)
```sh
$ ssh -i linux2keypair.pem ec2-user@ec2-54-164-68-76.compute-1.amazonaws.com
```
### Add a file to the DB
(From the directory that contains the keypair *.pem file.)
```sh
scp -i linux2keypair.pem ~/workspace/mamp/budhub-server/BudHubServer/*.php ec2-user@ec2-54-164-68-76.compute-1.amazonaws.com:/var/www/html
```
### API Endpoints
| Filename | Parameters |
| ------ | ------ |
| add_temp.php | pid=PRODUCT_ID&uid=USER_ID&qty=QUANTITY |
| add_user.php | email=EMAIL&pw=PASSWORD |
| get_cat.php | none |
| get_item.php | id=PRODUCT_ID |
| get_items.php | category=ITEM_CATEGORY |
| get_temp.php | uid=USER_ID |
| index.php | none |
| login.php | email=EMAIL&pw=PASSWORD |
| search_items.php | term=SEARCH_TEXT&sort=FILTER_BY_FIELD |
| social_login.php | email=EMAIL |
### Todo
 - Convert endpoints to use POST instead of GET