create view searchcriteria(transactionId,datecreated,transactionstate,createdbyuserid,chileanrut,decision) as
SELECT ig.transactionid,
       t.datecreated,
       COALESCE(t.status, ' '::character varying)                      AS transactionstate,
       COALESCE(t.usuario, ' '::character varying)                     AS createdbyuserid,
       COALESCE(cco.chileanrut, ' '::character varying)                AS chileanrut,
       COALESCE(sm.decision, ' '::character varying)
FROM (asfclientimpl.igdatasourceaccess ig
     JOIN asfclientimpl.systemevent s on (((ig.uuid)::text = (s.uuid)::text))
         JOIN asfclientimpl.messages m ON ((m.id_systemevent = s.id ))
             JOIN asfclientimpl.transaction t ON (((t.uuid)::text = (s.uuid)::text))
                 JOIN asfclientimpl.smartsdecisioning sm ON (((sm.uuid)::text = (s.uuid)::text))
                     JOIN asfclientimpl.consumer co ON (((co.uuid)::text = (s.uuid)::text))
                         JOIN asfclientimpl.chileanconsumer cco ON co.id = cco.id_consumer
    )
WHERE m.eventType='CI-RESPONSE' and s.description='Transaction completion';
