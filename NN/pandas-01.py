#!/usr/bin/env python
# coding: utf-8

# In[3]:


import pandas
food_info = pandas.read_csv("food_info.csv")
print(type(food_info))
print(food_info.dtypes)
print(help(pandas.read_csv))


# In[5]:


food_info.head(6) # 取前面数据，默认前5条


# In[12]:


food_info.tail(4)# 默认5行，显示后4行数据


# In[10]:


print(food_info.columns) # 打印列名


# In[13]:


print(food_info.shape) # 和numpy一样，获取维度


# In[17]:


print(food_info.loc[0]) # 取第 0 号数据，索引超过实际大小则报错
# print(food_info.loc[8618])


# In[19]:


# dtype 常见类型
# Object  -- 相当于 string 值
# int
# float
# datetime
# bool
# print(food_info.dtypes)


# In[22]:


food_info.loc[3:6] # 切片显示数据，从3-6，包含6的数据
# food_info.loc[[2,5,20]] # 取，2,5,10 下标的数据


# In[25]:


# 按取列数据
ndb_cols = food_info['NDB_No']
print(ndb_cols)


# In[26]:


# 取某两列
colums = ['Zinc_(mg)','Copper_(mg)']
zinc_copper = food_info[colums]
print(zinc_copper)


# In[30]:


# 查找，列名单位分组
col_names = food_info.columns.tolist() # 把列名取出作为一个列表
print(col_names)
gram_columns = []

for c in col_names:
    if c.endswith("(g)"):
        gram_columns.append(c) # 如果是 g 为单位，则添加到列表

gram_df = food_info[gram_columns]
print(gram_df.head(3))


# In[ ]:




