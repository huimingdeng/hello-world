#!/usr/bin/env python
# coding: utf-8

# In[10]:


import pandas
food_info = pandas.read_csv("food_info.csv")
# print(food_info.head(3))
print(food_info.columns)


# In[11]:


print(food_info['Iron_(mg)'])
div_1000 = food_info['Iron_(mg)']/1000
print(div_1000)


# In[12]:


water_energy = food_info['Water_(g)'] * food_info['Energ_Kcal']
print(water_energy)
print(food_info.shape)
food_info['Iron_(g)'] = food_info['Iron_(mg)']/1000
print(food_info.shape)


# In[ ]:




