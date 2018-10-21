# budhub-server

Connect to server:
ssh -i linux2keypair.pem ec2-user@ec2-54-164-68-76.compute-1.amazonaws.com

Transfer files to server:
scp -i linux2keypair.pem ~/workspace/mamp/budhub-server/BudHubServer/FILENAME.php ec2-user@ec2-54-164-68-76.compute-1.amazonaws.com:/var/www/html