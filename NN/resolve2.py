
level2 = { 	
	"name":"1-level-has_children_list",
	"children":[
		{
			"name":"2-level-1==>level2-son",
		},
		{
		 "name":"2-level-2",
		}
	]
		
}
level3 = { 	
	"name":"1-level-has_grandson_list-dict-list-dict",
	"children":[
		{
			"name":"2-level-1==>level3-grandson",
			"children":[
				{},
				{"name":"3-level-1"}
			]
		},
		{
		 "name":"2-level-2"
		}
	]
		
}

level4 = { 	
	"name":"1-level-has_grandson_list-dict-list-dict",
	"children":[
		{
			"name":"2-level-1==>level3-grandson",
			"children":[
				{},
				{"name":"3-level-1"},
				{"name":"3-level-2",
					"children":[
						{"name":"4-level-1"}
					]}
			]
		},
		{
		 "name":"2-level-2"
		}
	]
		
}

def resolve2(obj):
	if isinstance(obj,dict):

		has_key = False
		if "children" in obj:
			# if isinstance(obj['children'],list): # 如果值为列表，则再次遍历
			has_key = True
		has_name = False
		if "name" in obj:
			has_name = True

		if has_key and has_name:# 存在 children
			print(obj['name'])
			resolve2(obj['children'])
		elif has_name:
			print(obj['name'])
		else:
			print(obj)
	if isinstance(obj,list):
		for i in obj:
			resolve2(i)


resolve2(level4)