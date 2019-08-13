#!/usr/bin/env python
# coding: utf-8

# In[7]:


# 競賽題
import pandas as pd
import numpy as np
titanic_train = pd.read_csv("titanic_train.csv")
titanic_train.tail()


# In[13]:


# 年齡缺失值問題
age = titanic_train['Age']
# print(age.loc[0:10])
age_is_null = pd.isnull(age)
# print(age_is_null)
age_null_True = age[age_is_null] # 獲取缺失值
print(age_null_True)
age_null_count = len(age_null_True)
print(age_null_count)


# In[ ]:




