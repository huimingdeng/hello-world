#!/usr/bin/env python3

from sklearn.datasets import load_digits
import pylab as pl

digits = load_digits() # 载入数据集
print(digits.data.shape)

pl.gray()
pl.matshow(digits.images[0])
pl.show()

