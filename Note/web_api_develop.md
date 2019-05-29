# Web API 开发实践

参考，转载自 [Web API 开发实践](https://segmentfault.com/a/1190000019309160 "Web API 开发实践")

## 前言

本文主要介绍后端web api的设计与实现。demo代码链接：[github代码](https://github.com/Darkgel/teamblog-webservice-laraval)

## 基本架构

### 代码分层

应用的基本架构主要包含以下5个部分：

- Controller Layer（控制器层）
- Transformer Layer（转换层）
- Service Layer（服务层）
- Repository Layer（仓库层）
- Model Layer（模型层）

各个层次的主要职责如下图所示：

![5cee29a02e02182487](https://i.loli.net/2019/05/29/5cee29a02e02182487.png)

**详细说明**

1. 基本的程序流程如上图所示，从1到8。若业务逻辑比较简单，可以直接跳过Service层，由Controller层直接调用Repository层。

2. 各层次之间可以通过依赖注入联系起来。

3. 业务逻辑主要分布在Service层和Model层。Service层负责工作流逻辑，即任务的具体执行流程，如事务处理等；Model层负责领域逻辑，领域逻辑包括了业务规则、业务计算等。

4. 通常情况下，Service层由于包含了主要的工作流逻辑，其可复用性比较差，但当Service层的业务逻辑积累到一定程度的时候，会沉淀一些通用的业务逻辑（工作流逻辑），最好将通用的业务逻辑提取出来，形成一个Service层内的子层，称为“通用处理层”（General Process Layer），可以将这部分代码放到当前Services目录下的General目录中。

5. Service层的返回值:  **1.业务对象**（model等业务数据）**2.bool值**，指示处理结果。

6. ***当Service层的业务逻辑无法正常执行时，需要抛出业务处理异常BusinessException***（注意，不是程序执行异常。业务处理异常例子：如账户余额不足，无法转账）。通过业务处理异常，将不正常的业务处理结果返回给调用者（eg：Controller或其他Service）。而在正常执行业务逻辑的情况下，则返回Service层的正常返回值，即上面第5点。

7. 在每一层中，当新开一个子分类时，最好建立一个子分类的基类。以Controller层为例子，当需要在app/Api/Controllers/V1目录建立一个Blog子目录时，最好在建好后的目录中添加一个BaseController，作为该目录下的基类。

8. ***Model层可以细分为AR（ActiveRecord）层和Domain层。***Domain层通常是基于AR层。AR层中每个类对应一张数据库表，而Domain类中包含的数据可以来自多个AR类。
   
   - 通常会在AR层中写与数据库相关的代码，如表的关联关系，表属性的可取值等。
   - 通常会在Domain层中写相应的领域逻辑。eg ： 领域模型某些值的取值规则
   - Domain类代表一个完整的领域模型，而AR类则不一定构成一个完整的领域模型。eg ： 产品的数据存放在多张张表内：product_a和product_b等，因此会有多个AR类对应这些表；同时，可以引入一个名为“Product”的Domain类，它代表了一个完整的产品（领域模型）。Domain类可以基于底层AR类中一个(一般来说是基于主表)。






