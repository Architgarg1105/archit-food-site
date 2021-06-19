<?php
function similarity_distance($matrix,$cust1,$cust2)
{
    $similar = array();
    $sum=0;
    foreach($matrix[$cust1] as $key=>$value)
    {
        if(array_key_exists($key,$matrix[$cust2]))
        {
            $similar[$key] = 1;
        }
    }

    if($similar==0)
    {
        return 0;
    }

    foreach($matrix[$cust1] as $key=>$value)
    {
        if(array_key_exists($key,$matrix[$cust2]))
        {
            $sum = $sum + pow($value-$matrix[$cust2][$key],2);
        }
    }

    return 1/(1+sqrt($sum));
    
}

function getRecommendation($matrix,$customer)
{
    $total=array();
    $simsums=array();
    $ranks=array();
    foreach($matrix as $othercustomer=>$value)
    {
        if($othercustomer != $customer)
        {
            $sim=similarity_distance($matrix,$customer,$othercustomer);
            
            foreach($matrix[$othercustomer] as $key=>$value)
            {
                if(!array_key_exists($key,$matrix[$customer]))
                {
                    if(!array_key_exists($key,$total))
                    {
                        $total[$key]=0;
                    }
                        $total[$key]+=$matrix[$othercustomer][$key]*$sim;
                    if(!array_key_exists($key,$simsums))
                    {
                        $simsums[$key]=0;
                    }
                    $simsums[$key]+=$sim;
                }
                
            }
        }
    }
    foreach($total as $key=>$value)
    {
        $ranks[$key] = $value/$simsums[$key];
    }
    array_multisort($ranks,SORT_DESC);
    return $ranks;
}
?>