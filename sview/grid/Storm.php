--Begin-procedure ReportBody !($P1, $P2, $P3)

select
--to_char(ROWNUM)  rownum,
to_char(DECODE(SIGN((((NVL(I.QUANTITY, 0) + NVL(H.QUANTITY, 0)+ NVL(J.QUANTITY, 0) + NVL(K.QUANTITY, 0)+ NVL(L.QUANTITY, 0)+ NVL(M.QUANTITY, 0)) / 3) * .7) - ((NVL(I.QUANTITY, 0)+ NVL(K.QUANTITY, 0)+ NVL(M.QUANTITY, 0)) / 3)), 1,'N','Y'))  storm_item,
to_char(ROUND(((NVL(I.QUANTITY, 0)+ NVL(K.QUANTITY, 0)+ NVL(M.QUANTITY, 0)) / 3) - (B.CURBAL + NVL(E.ONORDER, 0)), 0))  storm_qty,
to_char(B.ITEMNUM)  itemnum ,
C.DESCRIPTION  description,
to_char(ROUND(((NVL(H.QUANTITY, 0)+ NVL(J.QUANTITY, 0)+ NVL(L.QUANTITY, 0)) / 3), 0))  three_yr_nonstorm_avg ,
to_char(ic.AVGCOST)  avgcost,   
to_char(D.MINLEVEL)  minlevel,
to_char(B.CURBAL)  curbal,
to_char((NVL(E.ONORDER, 0)))  onorder ,
to_char((B.CURBAL + NVL(E.ONORDER, 0)))  combined ,
to_char(ROUND(((NVL(I.QUANTITY, 0) + NVL(K.QUANTITY, 0)+ NVL(M.QUANTITY, 0)) / 3), 0))  three_yr_storm_avg,
(NVL(L.QUANTITY, 0))  nonstorm03,    
(NVL(M.QUANTITY, 0))  storm03,    
(NVL(J.QUANTITY, 0))  nonstorm02,    
(NVL(K.QUANTITY, 0))  storm02,       
(NVL(H.QUANTITY, 0))  nonstorm01,    
(NVL(I.QUANTITY, 0))  storm01                              

 FROM 
    (SELECT SUM(CURBAL) CURBAL, ITEMNUM, LOCATION FROM MAXIMO.INVBALANCES WHERE LOCATION = 'CENTRAL' GROUP BY ITEMNUM, LOCATION) B,
    ITEM C,
    INVENTORY D,
    (SELECT SUM(NVL(ORDERQTY, 0) - NVL(RECEIVEDQTY, 0)) ONORDER, POL.ITEMNUM FROM MAXIMO.PO P, MAXIMO.POLINE POL WHERE POL.ORDERQTY > 
    POL.RECEIVEDQTY AND POL.STORELOC = 'CENTRAL' AND P.PONUM = POL.PONUM AND P.STATUS = 'APPR' AND P.POTYPE NOT IN 
    (SELECT VALUE FROM MAXIMO.VALUELIST WHERE LISTNAME = 'POTYPE' AND MAXVALUE = 'BLANK') AND POL.ISSUE = 0 AND P.HISTORYFLAG = 0   
    GROUP BY POL.ITEMNUM) E,
    
    (SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM
     ((SELECT ITEMNUM, ABS(SUM(QUANTITY)) AS "QUANTITY" FROM MAXIMO.MATUSETRANS WHERE ISSUETYPE IN ('ISSUE', 'RETURN') AND STORELOC = 'CENTRAL' 
    --AND ((TRANSDATE BETWEEN TO_DATE($Jan01year1,'mmddyyyy') AND TO_DATE($Apr30year1,'mmddyyyy')) OR (TRANSDATE BETWEEN TO_DATE($Nov01year1,'mmddyyyy') 
    --AND TO_DATE($Dec31year1,'mmddyyyy'))) 
    GROUP BY ITEMNUM)
     UNION (SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM MAXIMO.MATRECTRANS WHERE ISSUETYPE = 'TRANSFER' AND 
    ((TOSTORELOC = 'CENTRAL' AND FROMSTORELOC IN ('EDOPS', 'EDOPS2')) OR (TOSTORELOC IN ('EDOPS', 'EDOPS2') AND FROMSTORELOC = 'CENTRAL')) 
    --AND ((TRANSDATE BETWEEN TO_DATE($Jan01year1,'mmddyyyy') AND TO_DATE($Apr30year1,'mmddyyyy')) OR (TRANSDATE BETWEEN TO_DATE($Nov01year1,'mmddyyyy') 
    --AND TO_DATE($Dec31year1,'mmddyyyy'))) 
    GROUP BY ITEMNUM
     )) GROUP BY ITEMNUM
    ) H,  
    (
     SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM
     ((SELECT ITEMNUM, ABS(SUM(QUANTITY)) AS "QUANTITY" FROM MAXIMO.MATUSETRANS WHERE ISSUETYPE IN ('ISSUE', 'RETURN') AND STORELOC = 'CENTRAL' 
    --AND (TRANSDATE BETWEEN TO_DATE($May01year1,'mmddyyyy') AND TO_DATE($Oct31year1,'mmddyyyy'))
    
    GROUP BY ITEMNUM)
     UNION
     (SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM MAXIMO.MATRECTRANS WHERE ISSUETYPE = 'TRANSFER' AND 
    ((TOSTORELOC = 'CENTRAL' AND FROMSTORELOC IN ('EDOPS', 'EDOPS2')) OR (TOSTORELOC IN ('EDOPS', 'EDOPS2') AND FROMSTORELOC = 'CENTRAL')) 
    --AND ((TRANSDATE BETWEEN TO_DATE($Jan01year1,'mmddyyyy') AND TO_DATE($Apr30year1,'mmddyyyy')) OR (TRANSDATE BETWEEN TO_DATE($Nov01year1,'mmddyyyy') 
    --AND TO_DATE($Dec31year1,'mmddyyyy'))) 
    GROUP BY ITEMNUM))
     GROUP BY ITEMNUM
    ) I,  
    (SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM
     ((SELECT ITEMNUM, ABS(SUM(QUANTITY)) AS "QUANTITY" FROM MAXIMO.MATUSETRANS WHERE ISSUETYPE IN ('ISSUE', 'RETURN') AND STORELOC = 'CENTRAL' 
    --AND ((TRANSDATE BETWEEN TO_DATE($Jan01year2,'mmddyyyy') AND TO_DATE($Apr30year2,'mmddyyyy')) OR (TRANSDATE BETWEEN TO_DATE($Nov01year2,'mmddyyyy') 
    --AND TO_DATE($Dec31year2,'mmddyyyy'))) 
    GROUP BY ITEMNUM)
     UNION (SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM MAXIMO.MATRECTRANS WHERE ISSUETYPE = 'TRANSFER' AND 
    ((TOSTORELOC = 'CENTRAL' AND FROMSTORELOC IN ('EDOPS', 'EDOPS2')) OR (TOSTORELOC IN ('EDOPS', 'EDOPS2') 
    AND FROMSTORELOC = 'CENTRAL')) 
    --AND ((TRANSDATE BETWEEN TO_DATE($Jan01year2,'mmddyyyy') AND TO_DATE($Apr30year2,'mmddyyyy')) 
    --OR (TRANSDATE BETWEEN TO_DATE($Nov01year2,'mmddyyyy') 
    -- AND TO_DATE($Dec31year2,'mmddyyyy')))
     GROUP BY ITEMNUM
     )) 
     GROUP BY ITEMNUM
    ) J,   
    (
     SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM
     ((SELECT ITEMNUM, ABS(SUM(QUANTITY)) AS "QUANTITY" FROM MAXIMO.MATUSETRANS 
        WHERE ISSUETYPE IN ('ISSUE', 'RETURN') AND STORELOC = 'CENTRAL' 
      --AND (TRANSDATE BETWEEN TO_DATE($May01year2,'mmddyyyy') 
      --AND TO_DATE($Oct31year2,'mmddyyyy')) 
    
    GROUP BY ITEMNUM)
     UNION
     (SELECT ITEMNUM, SUM(QUANTITY) AS "QUANTITY" FROM MAXIMO.MATRECTRANS 
          WHERE ISSUETYPE = 'TRANSFER' 
          AND ((TOSTORELOC = 'CENTRAL' 
          AND FROMSTORELOC IN ('EDOPS', 'EDOPS2')) 
          OR (TOSTORELOC IN ('EDOPS', 'EDOPS2') 
          AND FROMSTORELOC = 'CENTRAL')) 
    	--AND ((TRANSDATE BETWEEN TO_DATE($Jan01year2,'mmddyyyy') 
		--AND TO_DATE($Apr30year2,'mmddyyyy')) 
		--OR (TRANSDATE BETWEEN TO_DATE($Nov01year2,'mmddyyyy') 
    	--AND TO_DATE($Dec31year2,'mmddyyyy'))) 
    GROUP BY ITEMNUM
	           )
			)
     GROUP BY ITEMNUM
    ) K,  
    (SELECT 
			ITEMNUM, 
			SUM(QUANTITY) AS "QUANTITY" 
			
				FROM
                    (
					 (SELECT 
							ITEMNUM,
							 ABS(SUM(QUANTITY)) AS "QUANTITY" 
							 FROM MAXIMO.MATUSETRANS 
							 WHERE ISSUETYPE IN ('ISSUE', 'RETURN') 
							 AND STORELOC = 'CENTRAL' 
   						  -- AND ((TRANSDATE BETWEEN TO_DATE($Jan01year3,'mmddyyyy') 
						          AND TO_DATE($Apr30year3,'mmddyyyy')) 
						   --OR (TRANSDATE BETWEEN TO_DATE($Nov01year3,'mmddyyyy') AND TO_DATE($Dec31year3,'mmddyyyy'))
						) 
    			GROUP BY ITEMNUM)
				
     UNION 
	 (SELECT 
			 ITEMNUM,
			  SUM(QUANTITY) AS "QUANTITY" 
			  FROM MAXIMO.MATRECTRANS 
			   WHERE ISSUETYPE = 'TRANSFER' 
			   AND ((TOSTORELOC = 'CENTRAL' AND FROMSTORELOC IN ('EDOPS', 'EDOPS2')) 
			   		   OR (TOSTORELOC IN ('EDOPS', 'EDOPS2') AND FROMSTORELOC = 'CENTRAL')) 
             		  --AND ((TRANSDATE BETWEEN TO_DATE($Jan01year3,'mmddyyyy') AND TO_DATE($Apr30year3,'mmddyyyy')) 
			   OR (TRANSDATE BETWEEN TO_DATE($Nov01year3,'mmddyyyy') AND TO_DATE($Dec31year3,'mmddyyyy'))
			   ) 
    GROUP BY ITEMNUM
     )) GROUP BY ITEMNUM
    ) L,  
    (
     SELECT 
	 ITEMNUM, 
	 SUM(QUANTITY) AS "QUANTITY" 
	 FROM
     		((SELECT 
			     ITEMNUM, 
				 ABS(SUM(QUANTITY)) AS "QUANTITY" 
				    FROM MAXIMO.MATUSETRANS 
					   WHERE ISSUETYPE IN ('ISSUE', 'RETURN') 
					   AND STORELOC = 'CENTRAL' 
    				 --AND (TRANSDATE BETWEEN TO_DATE($May01year3,'mmddyyyy') AND TO_DATE($Oct31year3,'mmddyyyy')) 
    GROUP BY ITEMNUM)
     UNION
				 (SELECT 
				 ITEMNUM, 
				 SUM(QUANTITY) AS "QUANTITY" 
				 		FROM MAXIMO.MATRECTRANS 
								WHERE ISSUETYPE = 'TRANSFER' 
								AND ((TOSTORELOC = 'CENTRAL' AND  FROMSTORELOC IN ('EDOPS', 'EDOPS2')) 
								OR (TOSTORELOC IN ('EDOPS', 'EDOPS2') AND FROMSTORELOC = 'CENTRAL')) 
								AND ((TRANSDATE BETWEEN TO_DATE($Jan01year3,'mmddyyyy') AND TO_DATE($Apr30year3,'mmddyyyy')) 
								OR (TRANSDATE BETWEEN TO_DATE($Nov01year3,'mmddyyyy') AND TO_DATE($Dec31year3,'mmddyyyy')))
    GROUP BY ITEMNUM))
     GROUP BY ITEMNUM
    ) M,  
    INVCOST IC
    WHERE 
    
    B.ITEMNUM = C.ITEMNUM  
    and ic.itemnum = d.itemnum
    AND B.ITEMNUM = D.ITEMNUM
    AND B.ITEMNUM = E.ITEMNUM(+)
    
    AND B.ITEMNUM = H.ITEMNUM(+)
    AND B.ITEMNUM = I.ITEMNUM(+)
    AND B.ITEMNUM = J.ITEMNUM(+)  
    AND B.ITEMNUM = K.ITEMNUM(+)    
    AND B.ITEMNUM = L.ITEMNUM(+)    
    AND B.ITEMNUM = M.ITEMNUM(+)    
    AND D.LOCATION = 'CENTRAL'
    and ic.location = d.location
    --[$stock_item_range]
    --[$storm_items_only]
    GROUP BY ROWNUM, B.ITEMNUM,
    C.DESCRIPTION,
    ROUND(((NVL(H.QUANTITY, 0) + NVL(J.QUANTITY, 0)+ NVL(L.QUANTITY, 0)) / 3), 0),  
    
    ic.AVGCOST,
    D.MINLEVEL,
    B.CURBAL,
    E.ONORDER,
    ROUND(((NVL(I.QUANTITY, 0) + NVL(K.QUANTITY, 0)+ NVL(M.QUANTITY, 0)) / 3), 0),
    
    H.QUANTITY,
    I.QUANTITY,
    
    J.QUANTITY,         
    K.QUANTITY,        
    L.QUANTITY,         
    M.QUANTITY       
    ORDER BY B.ITEMNUM  


