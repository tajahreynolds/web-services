#!/bin/bash
curl -X POST -d "{\"key\":\"${1}\",\"uid\":\"campbest\"}" \
	 	-H "Content-Type: application/json" \
		 	http://ceclnx01.cec.miamioh.edu/~campbest/cse451-campbest-web-public-2021/kv/kv.php/api/v1/hash

