-- --------------------------------------------------------

--
-- Структура таблицы `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` varchar(32) COLLATE utf8_bin NOT NULL,
  `long_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `short_url` varchar(127) COLLATE utf8_bin NOT NULL,
  `host` varchar(127) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UI_short_url` (`short_url`);
