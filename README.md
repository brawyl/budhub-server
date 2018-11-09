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
| Filename | HTTP Method: Parameters |
| ------ | ------ |
| add_history.php | POST: uid, total, summary, item, date |
| add_review.php | POST: date, title, text, rating, author, uid, pid |
| add_temp.php | POST: pid, uid, quantity |
| add_user.php | POST: email, pass |
| del_temp.php | POST: uid, lid |
| get_cat.php | GET: none |
| get_history.php | POST: uid |
| get_item.php | GET: id |
| get_items.php | GET: category |
| get_reviews.php | POST: uid, pid |
| get_temp.php | POST: uid |
| index.php | none |
| load_temp.php | POST: order, uid |
| login.php | POST: email, pass |
| search_items.php | POST: uid, term, field|
| social_login.php | POST: email |
