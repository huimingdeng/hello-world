#!/usr/bin/env python
#-*- coding:utf-8 -*-

import curses
from random import randrange,choice
from collection import defaultdict

actions = ['Up','Left','Down','Right','Restart','Exit']
letter_code = [ord(ch) for in 'WASDRQwasdrq'] # 将获取的ASCII码转换对应是否匹配对应的字母
actions_dict = dict(zip(letter_code,actions*2)) #关联输入转换的字母组成字典

''' 分析：
处理游戏，使用“状态机”技术
P.S '.' 和 '`' 标识方向 '<=>':标识，game可以重启返回到init,init预加载到game
					Win
		./			 `|			\.
	Init	<=>		Game 	->	Exit
		`\			|.			/`
					Gameover

state 可用于存储当前状态，start_actions词典用于转换规则，key设置为 state value为返回下一状态的函数
因此：
	Init:init()
		-> Game
	Game:game()
		-> Init
		-> Exit
		-> Win
		-> Gameover
	Win:lambda:not_game("Win") # 匿名函数判断是否进入再次游戏，还是退出
		-> Init
		-> Exit
	Gameover:lambda:not_game("Gameover") # 匿名函数判断是否进入再次游戏，还是退出
		-> Init
		-> Exit

	当遇到 Exit 退出

'''

def main(stdstr):

	def init():
		''' 重置游戏 '''
		return 'Game'

	def not_game():
		''' 判断Win或游戏Gameover-->读取用户输入的动作(action) '''
		response = defaultdict(lambda:state) # 默认当前状态，没有就当前状态的界面循环
		response['Restart'],response['Exit'] = 'Init','Exit'
		return response[action]

	def game():
		''' 游戏 '''
