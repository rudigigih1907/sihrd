# Catatan 

#### Mengakses adminer di localhost

Jika di server, tinggal akses IP_SERVER:6033 misal 10.60.36.60:6033.

Tapi kalau di lokal, 
1. Ketikkan perintah untuk mengecek docker sudah jalan apa belum.

``` 

   $:  ifconfig | grep docker0 
   #:  return docker0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
 
``` 

2. Kalau return nya ada, silahkan lihat ip-nya: 

```
ifconfig docker0

# return 
docker0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 172.17.0.1  netmask 255.255.0.0  broadcast 172.17.255.255
        inet6 fe80::42:f9ff:fe8d:852a  prefixlen 64  scopeid 0x20<link>
        ether 02:42:f9:8d:85:2a  txqueuelen 0  (Ethernet)
        RX packets 75175  bytes 43541461 (43.5 MB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 130039  bytes 181650020 (181.6 MB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

# Lihat inet nya, => 172.17.0.1 

```


Gunakan IP itu di adminer:


| Label         | Value           | 
| ------------- |:---------------:|
| System        | MySQL           |
| Server        | 172.17.0.1:6033 |
| Username      | root            |
| Password      | password_kamu   |
| Database      | siadmin         |