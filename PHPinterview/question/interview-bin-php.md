1. 一投资者以每股75元买入一公司股票n股，此后以每股120元卖出60%，剩下随后一天以每股70元全部低价卖出，如果他从这次股票操作中获利7500元，那么 n 等于多少?  （5分）
   
    **$A. 300$**     B. 350    C. 200     D. 250    E. 400    

个人解题思路：`卖出成交总额 - 买入成交额 = 利润`

$$
\because   60\%n * 120 + 40\%n * 70 - 7500 = 75n \\
\therefore 25n = 7500 \\
\therefore n = 300
$$

2. 以下每题中请您分析其排列规律，并按照其规律从ABCDE五个备选图形中选择相应图形填入问号中 (5分+5分)

![2-1](https://i.loli.net/2019/07/23/5d367bc12463f50649.jpg)

3. 写一种验证中国大陆11位手机号码的正则表达式。（10分）

`考验正则表达式能力`  `/^1[38][0-9]{9}/`

4. 【填空题】有一种细菌，经过一分钟分裂为 2 个，再过一分钟，分裂为 4 个，将这样的细菌放在一个瓶子里面，一个小时后瓶子被细菌充满了。现假设一开始放入瓶中的为 2 个细菌，那么到充满瓶要____分钟? （5分）

`考验基本逻辑思维`

5. 【流程题】请用流程图画出请假流程(小于等于3天，直属上司可审批，大于3天需要部门主管二次审批) （15分）

`考验流程判断思维`

6. 【编程题】Write a function to display the below diagram given the line number as input (25分)

```php
    *
   ***
  *****
 *******
*********
-------------------------- example code --------------------------
<?php 
function display($input){
    // 循环行数
    for($i=1;$i<=$input;$i++){
        // 计算，输出前面的空格
        $t = $input-$i;
        for($s=0;$s<$t;$s++){
            echo ' ';
        }
        // 输出列为 * 符合
        for($j=0;$j<(2*$i-1);$j++){
            echo "*";
        }
        echo "\n";
    }
}

display(5);
```

`编程考核`

7. 【SQL题】(数据库MySQL/ORACLE)每题尽可能以一条SQL语句完成。（30分）

表名 StudentScore

| id  | class | student | subject | score |
|:---:|:-----:|:-------:|:-------:|:-----:|
| 1   | 1     | Jim     | 语文      | 100   |
| 2   | 1     | Jim     | 数学      | 99    |
| 3   | 1     | Jim     | 英语      | 79    |
| 4   | 1     | Jim     | 数学      | 99    |
| 5   | 1     | Lucy    | 语文      | 92    |
| 6   | 1     | Lucy    | 数学      | 87    |
| 7   | 1     | Lucy    | 英语      | 98    |
| 8   | 1     | Tom     | 语文      | 81    |
| 9   | 1     | Tom     | 数学      | 100   |
| 10  | 1     | Tom     | 英语      | 99    |
| 11  | 1     | Tom     | 语文      | 81    |

1. 写 SQL 删除上表中重复的记录，保留一条记录。（5分）
   
   ```sql
   DELETE FROM StudentScore WHERE student IN ( -- 首先查询具有重复科目值的记录，按照科目和学生分组
       SELECT student FROM StudentScore GROUP BY `subject`,`student` HAVING count(`subject`) > 1
   ) AND NOT IN (
       -- 删除 ID 值最大的记录，小的不删除
   )
   ```

2. 每页显示3条记录，写 SQL 查询出第 4 页显示的数据，按 ID 增序（5分）
   
   ```sql
   SELECT * FROM StudentScore ORDER BY ID ASC Limit 9,3 -- page = total/3 ∴ p=4 = 11/3  -- 3 ... 1
   -- index 0 -> 10, ∴ index-9 => 10(id)
   ```

3. 写SQL查询出所有科目成绩都大于80分的学生。（10分）
   
   ```sql
   -- 1. 查询获取不小于80分的学生信息
   SELECT * FROM studentscore AS res WHERE res.student NOT IN(
      -- 查询分数小于80分学生
      SELECT DISTINCT(tmp.student) FROM studentscore AS tmp WHERE tmp.score < 80
   )
   --------------------------------
   -- 2. 方案二，来源网络
   SELECT DISTINCT student FROM studentscore a WHERE score >= 80 AND NOT EXISTS ( 
      SELECT 1 FROM studentscore b WHERE b.student = a.student AND b.`subject` != a.`subject` AND b.score < 80
   )
   ORDER BY a.student
   ```

4. 写SQL查询1班每个学生总分和1班学生总分。（10分）

```sql
SELECT student,SUM(score) AS total FROM studentscore GROUP BY student UNION SELECT class AS student, SUM(score) AS total FROM studentscore GROUP BY class
```


