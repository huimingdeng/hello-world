# 《秒懂设计模式》刘韬

## 15章 迭代器（Iterator）

迭代，在程序中特指对某集合中各元素逐个取用的行为。迭代器(Iterator)提供一种机制，按顺序访问集合中的各元素，不需要知道集合内部的构造。

**物以类聚**

书中Java案例：代码清单15-1 非迭代遍历全书

```java
public class Book {
    class Page {
        private int index;
        
        public Page(int index) {
            this.index = index;
        }
        
        @Override
        public String toString(){
            return "阅读第" + this.index + "页"
        }
    }
    
    private List<Page> pages = new ArrayList<>();
    
    public Book(int pageSize) {
        for (int i = 0; i < pageSize; i++) {
            pages.add(new Page(i+1));
        }
    }
    
    public void read() {
        for (Page page : pages) {
            System.out.println(page);
        }
    }
}
```

代码清单 15-4

```java
public class DrivingRecorder {
    private int index = -1; // 当前记录位置
    private String[] records = new String[10]; // 假设只能记录10条视频

    public void append(String record) {
        if (index == 9) { // 索引重置，从头覆盖
            index = 0;
        } else { // 正常覆盖下一条
            index++;
        }
        records[index] = record;
    }

    public void display() { // 循环数组并显示所有10条记录
        for (int i = 0; i < 10; i++) {
            System.out.println(i + ": " + records[i]);
        }
    }
}

```

