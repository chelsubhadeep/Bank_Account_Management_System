<?php
	$sql="SELECT
    user_detail.uid,
    NAME,
    mail_id,
    gender,
    mobile_num,
    user_detail.add,
    state,
    city,
    bank,
    brunch,
    ifsc,
    ac_no,
    GROUP_CONCAT(
        CASE WHEN damt <> 0 AND TRANSACTION.status <> 'CLOSED' AND TRANSACTION.status <> 'OPEND' THEN damt ELSE NULL
    END SEPARATOR ','
) AS damt,
(
    CASE WHEN TRANSACTION.status <> 'CLOSED' THEN SUBSTRING_INDEX(
        GROUP_CONCAT(bal
    ORDER BY
        tid
    DESC
        ),
        ',',
        1
    ) ELSE NULL
END
) AS bal,
GROUP_CONCAT(
    CASE WHEN wamt <> 0 AND TRANSACTION.status <> 'CLOSED' AND TRANSACTION.status <> 'OPEND' THEN wamt ELSE NULL
END SEPARATOR ','
) AS wamt,
TRANSACTION.status
FROM
    `user_detail`
LEFT JOIN `transaction` ON TRANSACTION
    .uid = user_detail.uid
GROUP BY
    uid"

$sql="SELECT
    aircraft.anme,
    SUBSTRING_INDEX(
        GROUP_CONCAT(SELECT AVG(employee.salary) FROM employee),
        ',',
        1
    )
FROM
    aircraft
INNER JOIN certified ON aircraft.aid = certified.aid
INNER JOIN employee ON certified.eid = employee.eid
GROUP BY
    aircraft.aid"
?>