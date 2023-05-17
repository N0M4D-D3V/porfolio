#! /bin/zsh

#clear 
./clear-rise.sh

# cp info
cd ..
cd ..
sudo cp -r ./portfolio/* /opt/lampp/htdocs

#rise xampp
sudo /opt/lampp/lampp start
