## 六星-Part-Three

### 2019-9-10

一：有一个文件ip.txt，每行一条ip记录，共若干行，下面哪个命令可以实现“统计出现次数最多的前3个ip及其次数”？（ ）
A、uniq -c ip.txt
***B、sort -nr ip.txt | uniq -c | sort -nr | head -n 3***
C、cat ip.txt | count -n | sort -rn | head -n 3
D、cat ip.txt | count -n



答案解析：
本题利用管道符"|"组合多个命令，uniq -c filename用于去除冗余并统计每一行出现的次数。 sort -r指逆序排序，-n指按数字字符串大小排序 head指定数量。 剩下的二选一交给运气。

正确的命令应该为： sort -nr ip.txt | uniq -c | sort -nr | head -n 3 第一次排序，把ip按顺序排列，因为第二个uniq只会合并相邻项 第二次排序，才是把ip按出现次序大小从大到小排列 最后取前三项结果。




