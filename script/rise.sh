#! /bin/zsh
# script by N0M4D

#clear
echo '<> Clearing previous deploy...' 
./clear-rise.sh

# cp info
echo '<> Copying curret deploy...'
cd ..
cd ..
sudo cp -r ./portfolio/* /opt/lampp/htdocs

#rise xampp
echo '<> Rising XAMPP...'
sudo /opt/lampp/lampp start
