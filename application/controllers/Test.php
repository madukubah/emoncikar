SELECT 
	nomenclature.code,
    nomenclature.name,
	activity.*,
    'F' as AuFnF,
    'F' as AUpLkS,
    'F' as AUpLkS,
    SUM( budget.nominal ) as budget_nominal
FROM 
	activity
INNER JOIN
	nomenclature
on 
	nomenclature.id = activity.nomenclature_id
INNER JOIN
	budget
on 
	budget.activity_id = activity.id
GROUP BY activity.id