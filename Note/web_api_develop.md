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

### 目录结构

如图所示：



**详细说明**

1. 如上图所示，各个层次Controller、Service、Transformer、Model、Repository都有自己相应的目录

2. Controllers目录说明（Controller层）
   
   - Controller层，所有api的控制器放在该目录下，按版本分类（V1，V2...），版本目录下按照业务分类
   
   - Controller层的职责：
     
     - 校验输入
     - 处理请求&构造响应
     - 调用Transformer层、Service层、Repository层，但不应该在Controller中包含任何业务逻辑
   
   - 在各个版本目录之下（V1，V2...）,按照业务将Controller分到不同的子目录中（eg：Blog，Marketing...），而不是按照数据库进行划分，虽然按照业务划分与按照数据库划分的结果可能一样
   
   - 每个版本目录下有一个版本控制器（eg:V1Controller）,该版本下的所有控制器需要继承自该控制器。版本控制器必须继承自App\Http\Controllers\ApiController
   
   - 按照业务划分的控制器子目录中应该有一个控制器基类（eg：BaseController），所有该目录下的控制器继承自该基类控制器

3. Common目录说明
   
   - Common目录用于放置一些在整个项目中都可以使用的通用代码，通常这些代码不应该包含特定的业务逻辑
   - 子目录Components用于放置组件代码（注意：这些组件代码不应该继承自框架代码/第三方代码，否则应该将其放置到Extensions目录）。通常这些代码能提供一个特定的功能，但又不依赖框架本身，可以作为其他项目的第三方包使用
   - 子目录Extensions用于放置扩展了框架代码/第三方代码原有功能的代码（通常意味着继承自框架代码/第三方代码），注意与Components区分
   - 子目录Enum用于放置“常量定义”的代码
   - 子目录Helpers用于放置一些工具类，工具类中通常会提供一些静态方法，方便调用
   - 子目录Scopes用于放置与Eloquent ORM相关的Scopes定义
   - 子目录Lib用于存放一些底层的库文件

4. Models目录说明（Model层）
   
   - Model层，所有的模型类放置在该目录下。通常按数据库进行分类（eg: DbBlog）
   - Model层的职责（继承自Eloquent class时）：
     - 对应一张数据库表，一个model实例表示表中一条记录
     - 处理property ，如$db, $table，$fillable等；处理scope
     - Accessors & Mutators : 在从model实例中获取或存储属性时对其进行格式化
     - 关联关系配置： 使用hasMany()、belongsTo()等
     - model本身行为的代码(即领域逻辑代码，属于业务逻辑的一部分)，包括了model在运行时的状态变化，如status由valid变换成invalid
   - Model层的职责（不继承自Eloquent class时）：
     - 作为一个领域类，包含领域逻辑
   - 当一个完整的领域类被分割成多个数据库表存储在数据库中时，可以在各数据库目录（eg：DbBlog）下创建Domain目录，用于存放完整的领域类。
   - 所有对应数据库表的Model应该间接继承自AppModel。每个数据库目录下（eg: DbBlog）应该包含一个BaseModel（代表该数据库），其他Model继承自该BaseModel
   - 注意：对数据库表进行“增删改查”的操作代码请不要放置到Model，应该将“增删改查”的代码放置到Repository层

5. Repositories目录说明（Repository层）
   
   - Repository层，所有仓库类放置在该目录下。通常按照业务/数据库进行划分
   
   - Repository层的职责：
     
     - 仅包含对数据库直接进行增删改查操作的代码，辅助Model层（除此之外请不要放置其他代码；通常增删改的逻辑比较单一，而查则会有多种情况，将各种查询逻辑在此处实现）
   
   - Repository层仅包含直接对数据库进行操作的代码，其他涉及外部调用等功能的代码应该考虑放置在Service层中。
   
   - 所有的仓库类应该继承自AppRepository类。

6. Services目录说明（Service层）
   
   - Service层，所有的服务类放置在该目录下。通常按业务进行分类
   
   - Service层的职责：
     
     - 处理牵涉到的外部行为：如发送邮件，使用外部API（如使用队列，调用thrift，调用其他团队的服务等）
     - 包含业务逻辑（主要是工作流逻辑(workflow logic),即完成某个任务的具体流程）：service层是业务逻辑存在的主要地方，辅助Controller层；当需要对数据库进行增删改查时，则应该调用相应的Repository层
   
   - 所有的服务类都应该继承自AppService类

7. Transformers目录说明（Transformer层）
   
   - Transformer层，所有的转换类放置在该目录下。通常按照业务进行分类。
   
   - Transformer层的职责：
     
     - 处理显示逻辑
     - 管理API接口的输出（使接口的输出与底层的Service，Repository，Model等解耦，这样即使底层数据库表进行了修改，也可以不影响接口的使用）
   
   - 所有的转换类都应该继承自AppTransformer类

### 响应

**注意**：这里讨论的响应格式指的是应用业务相关的响应，由第三方提供的api接口的响应不纳入处理范围（eg：laravel passport提供的响应，swagger提供的响应）

#### 响应分类

1. 成功类响应：http响应码介于200~300。返回此类响应表示服务器完整处理了该请求，没有未捕捉处理的异常或错误。（除了正常情况，***在业务逻辑处理失败时，也会返回此类响应，同时会带上相应的业务处理失败信息***）
2. 失败类响应 ： http响应码不介于200~300。返回此类响应表示服务器抛出了未捕捉处理的异常或错误

##### 响应案例

###### 成功响应：

1.业务逻辑处理成功

![5cee2b709fb7a54411](https://i.loli.net/2019/05/29/5cee2b709fb7a54411.png)

2.业务逻辑处理失败

![5cee2bdf80b1a21427](https://i.loli.net/2019/05/29/5cee2bdf80b1a21427.png)

结构如上图所示：结构与业务逻辑处理成功是一样。区别在于成功时的code为0，失败时则为相应的错误码，code的取值为为app\Common\Enum\ErrorCode.php中的**业务级错误码**(见下面的错误码)。

###### 失败响应：

![5cee2c6f8595934606](https://i.loli.net/2019/05/29/5cee2c6f8595934606.png)

失败响应的格式配置在文件config/api.php中（关键词为：errorFormat）。主要包括了message、errors、code、status_code、debug。有些信息在生产环境不会展示。



#### 响应格式化处理的思路

响应格式化处理的大致思路：对特定的请求（对此类请求做标记）的处理结果，在返回给用户时进行拦截（使用事件机制），对原有响应进行格式化处理。  
响应的代码：

- App\Http\Middleware\BusinessFormatOutput : 路由中间件，在某些路由放置该中间件，则标记该请求，表明其响应需要进行格式化处理
- App\Listeners\AddBusinessStatusToResponse : 事件handler，处理由dingo触发的ResponseWasMorphed事件，对响应进行格式化处理
- App\Http\Controllers\ApiController.php文件中的常量BusinessStatusHeader，通过响应中的header为中介，将业务逻辑处理结果传递到2中的事件handler中，并最终构成格式化响应。



### 错误码

错误码相关的代码文件为：app\Common\Enum\ErrorCode.php  
错误码格式：A-BB-CCC

- A : 表示错误级别,0代表成功，1代表系统级错误，2代表服务（业务）级错误；
- B : 表示项目/模块/分类；
- C : 具体错误编号；

不同错误级别错误码的使用：

- 业务级错误码用于表示业务处理结果。
  
  - Service层业务处理失败，抛出BusinessException时使用业务级状态码
  - Controller层构造响应时，定义响应的业务处理结果，eg：`return $this->response->array($validator->errors()->toArray())->withHeader(self::BusinessStatusHeader, [ErrorCode::BUSINESS_INVALID_PARAM`, '业务处理结果信息']);
  - 用于日志记录（业务相关的日志）

- 系统级错误码用于表示代码运行异常。
  
  - 用于记录系统性异常日志，Controller、Service、Transformer、Repository、Model各个层皆可

**注意：**

1. 错误码文件不能重写，若有新的错误码，请按现有分类添加，不能删除或修改旧的错误码。



### 异常与异常处理

异常相关的代码：app/Exceptions目录。**在应用代码中，只能抛出BusinessException或者是SystemException。请不要抛出其他的异常，不同异常通过异常的code来区分**（code的定义在app/Common/Enum/ErrorCode.php）。

当业务逻辑执行失败时，抛出BusinessException，常见可能情况如下：

- Controller层校验输入失败，抛出BusinessException
- Service层业务逻辑执行失败，直接抛出BusinessException（如账户余额不足，无法转账）
- Service层业务逻辑执行失败（但没有抛出异常，而是通过返回值指明执行失败），则接受到该返回值的调用者抛出BusinessException

Controller必须捕捉BusinessException（因此即使抛出了BusinessException，依然要返回一个成功类响应（见上文）），并根据BusinessException的相应信息构造响应。建议所有Controller的action以下面的格式进行编写。

```
public function add(Request $request, ReserveService $reserveService){
    try{//将所有的控制器逻辑放到try块中
        $postData = $request->post();
 
        //校验数据有效性
        /** @var \Illuminate\Validation\Validator $validator*/
        $validator = Validator::make($postData, [
            'orderName' => 'required',
            'reservePhone' => 'required',
        ]);
 
        if($validator->fails()){//校验失败
            new BusinessException(ErrorCode::BUSINESS_INVALID_PARAM, "", $validator->errors()->toArray());
        }
 
        $result = $reserveService->addReservation($postData);
        if(true === $result){
            //业务逻辑执行成功
            return $this->response->array([]);
        }else{
            //通过返回值指示业务逻辑执行失败
            throw new BusinessException(ErrorCode::BUSINESS_BUSY);
        }
    } catch (BusinessException $e){//捕捉BusinessException，根据异常的信息构造响应，下面这段代码可以通用
        return $this->response->array($e->getExtra())
            ->withHeader(self::BUSINESS_STATUS_HEADER, [$e->getCode(), $e->getMessage()]);
    }
}
```

当发生底层系统异常时，抛出SystemException。没有捕捉处理的SystemException会造成一个失败类响应。

### 日志与预警

日志组件与预警组件的存在是为了更好的维护项目，及时处理bug。应该根据自己的需要添加相应的日志组件和预警组件。

### 文档

选择集成一个成熟的文档工具，如swagger，blueprint等。






