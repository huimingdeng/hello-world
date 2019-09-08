## 线性回归

- 非常重要
- 基本--必须掌握的知识
- [公式参考](https://blog.csdn.net/katherine_hsr/article/details/79179622 "公式参考")

### 例子：

| 工资    | 年龄  | 额度    |
| ----- | --- | ----- |
| 4000  | 25  | 20000 |
| 8000  | 30  | 70000 |
| 5000  | 28  | 35000 |
| 7500  | 33  | 50000 |
| 12000 | 40  | 85000 |

两个特征： 工资和年龄

* 目标： * 预测银行会贷款给我多少钱（标签）

考虑：工资和年龄都会影响最终银行贷款结果，那么它们各自有多大影响？（参数）

通俗解释：

- X1,X2 就是我们的两个特征（年龄，工资）Y是银行最终借多少钱
- 找到最合适的一条线（想象一个高纬度）来最好的拟合我们的数据点

![StwPVIu2qY1xQcr](https://i.loli.net/2019/09/01/StwPVIu2qY1xQcr.png)

拟合平面公式：$\theta_{0}$ 是偏置项

$$
h_{\theta}(x) = \theta_0+\theta_1+\theta_{2} 
$$

整合：

$$
h_{\theta}(x)= \sum_{i=0}^n\theta_{i} x_i=\theta^Tx
$$

- $ \sum_{i=0}^n \theta_ix_i$ 表示求和

- 误差
  
  真实值和预测值之间肯定是要存在差异的（用$\varepsilon$ 来表示误差）

对于每个样本：$$y^{(i)} = \theta^Tx^{(i)}+\varepsilon^{(i)}$$

- $y^{(i)}$:表示真实值
- $\theta^Tx^{(i)}$:表示预测值

### 误差

- 误差 $\varepsilon^{(i)}$ 是独立并具有相同分布，并服从均值为0方差为 $\theta^2$ 的高斯分布

- 独立：张三和李四一起来贷款，他俩没关系

- 同分布：他两都来得是我们假定的这家银行

- 高斯分布：银行可能会多给，也可能少给，但是绝大多数情况这个浮动不会太大，极小情况浮动比较大，符合正常情况

- 推导：
  
  - 预测值与误差：$y^{(i)}=\theta^Tx^{(i)}+\varepsilon^{(i)} $  (1)
  
  - 由于误差服从高斯分布：$p(\varepsilon^{(i)}) = \frac{1}{\sqrt{2\pi}\sigma}\exp(-\frac{(\varepsilon^{(i)})^2}{2\sigma^2})$   (2)
  
  - 将（1）式代入（2）式： $p(y^{(i)}|x^{(i)};\theta) = \frac{1}{\sqrt{2\pi}\sigma}\exp(-\frac{(y^{(i)}-\theta^Tx^{(i)})^2}{2\sigma^2})$  (3)

- 似然函数：（根据样本估计参数值）

$$
L(\theta) = \prod_{i=1}^mp(y^{(i)}|x^{(i)};\theta) = \prod_{i=1}^m\frac{1}{\sqrt{2\pi}\sigma}\exp(-\frac{(y^{(i)}-\theta^Tx^{(i)})^2}{2\sigma^2})
$$

- 解释：什么样的参数跟我们的数据组合后恰好是真实值

- $\prod$ : N 元乘积

- 对数似然：

$$
\log L(\theta) = \log \prod_{i=1}^{m} \frac{1}{\sqrt {2\pi}\sigma } \exp(- \frac{(y^{(i)}-\theta^Tx^{(i)})^2}{2\sigma^2})
$$

- 解释：乘法难解，加法容易，对数里面乘法转换成加法
- 展开简化：$\log{A}+\log{B}$

$$
\sum_{i=1}^m{\log\frac{1}{\sqrt{2\pi}\sigma}}\exp{(-{\frac{(y^{(i)}-\theta^Tx^{(i)})^2}{2\sigma^2}})} \\
= m \log{\frac{1}{\sqrt{2\pi}\sigma}}-\frac{1}{\sigma^2} \cdot \frac{1}{2}\sum_{i=1}^m{(y^{(i)}-\theta^Tx^{(i)})^2}
$$

目标：让似然函数（对数变化后也一样）越大越好

$$
J(\theta) = \frac{1}{2}\sum_{i=1}^m{(y^{(i)}-\theta^Tx^{(i)})^2}  {(最小二乘法)} 
$$

目标函数：

$$
J(\theta) = \frac{1}{2} \sum_{i=1}^m{(h_{\theta} (x^{(i)})-y^{(i)})}^2 \\
 = \frac{1}{2} (X\theta-y)^T(X\theta-y)
$$

求偏导：

$$
\nabla_{\theta}J(\theta) = \nabla_{\theta}(\frac{1}{2} (X\theta-y)^T(X\theta-y))\\
 = \nabla_{\theta}(\frac{1}{2}(X^T\theta^T-y^T)(X\theta-y)) \\
 = \nabla_{\theta}(\frac{1}{2}(\theta^TX^TX\theta-\theta^TX^Ty-y^TX\theta+y^Ty)) \\
 = \frac{1}{2}(2X^TX\theta-X^Ty-(y^TX)^T) \\
 =X^TX\theta-X^Ty
$$

偏导等于0：

$$
\theta = (X^TX)^{-1}X^Ty
$$

#### 评估方法：

最常用评估项：

$$
R^2:1-\frac{\sum_{i=1}^m(\hat{y_i}-y_i)^2}{\sum_{i-1}^m(y_i-\overline{y})^2}  
\frac{\cdots残差平方和}{\cdots类似方差项}
$$

$R^2$ 的取值越接近1我们认为模型拟合的越好












