fast-ru-morf
=======
Fast russian morfology. No words lemmas, no spell suggest. Can be used only for seacrh or spellcheck (without suggest).


##RU

Быстрая русская морфология, не выводит леммы слова (падежи, род и прочее). Только id слова (омонемической группы).
Можно использовать только для организации поиска с учетом морфологии и для проверки орфографии (без вывода подсказок).  

Более подробное описание читайте на Хабре.


##Using
MorfFindGroup(UTF8_String $Word); Returns WordId or NULL.

Получает строку в UTF8, содержащую слово. Возвращает id слова (омонемической группы) или NULL если слова нет в базе.

```
	include('morf.php');
	if(MorfFindGroup('Автобус')===MorfFindGroup('Автобусы'))
		echo 'match';
	else
		echo 'not match';
```




