#Sync Time from NIST time server.
#===========
#Requires `ntp` to be installed. If command fails, run `sudo apt-get install ntp` first.

date ; sudo service ntp stop ; sudo ntpdate -s time.nist.gov ; sudo service ntp start ; date
