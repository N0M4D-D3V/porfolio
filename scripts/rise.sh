#! /bin/zsh

#clear
echo 'Clearing previous files ...' 
./clear-rise.sh

# cp info
echo 'Copying new files into htdocs folder ...'
cd ..
cd ..
sudo cp -r ./portfolio/* /opt/lampp/htdocs

#rise xampp
sudo /opt/lampp/lampp start