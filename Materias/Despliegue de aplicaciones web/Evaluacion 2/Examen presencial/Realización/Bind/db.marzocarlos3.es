;
; BIND data file for local loopback interface
;
$TTL	604800
@	IN	SOA	marzocarlos3.es. root.marzocarlos3.es. (
			      2		; Serial
			 604800		; Refresh
			  86400		; Retry
			2419200		; Expire
			 604800 )	; Negative Cache TTL
;
@	IN	NS	marzocarlos3.es.
@	IN	A	10.0.2.15
@	IN	AAAA	::1
ftp	IN	A	45.6.78.192
prueba	IN 	CNAME	marzocarlos3.es.
