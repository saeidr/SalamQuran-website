<?php
namespace lib\app;


class translate
{
	public static function get_translate($_lang)
	{
		$list = self::translate_list();
		$result = [];
		foreach ($list as $key => $value)
		{
			if(isset($value['language']) && $value['language'] === $_lang)
			{
				$result[] = $value;
			}
		}

		return $result;
	}


	public static function current_lang_translate()
	{
		return self::get_translate(\dash\language::current());
	}


	public static function table_name($_id)
	{
		$list = self::translate_list();

		foreach ($list as $key => $value)
		{
			if(isset($value['index']) && isset($value['language']))
			{
				if(substr($_id, 0, 2) === $value['language'] && intval(substr($_id, 2)) === $value['index'])
				{
					return $value;
				}
			}
		}
		return false;
	}


	public static function translate_site_list()
	{
		$list      = self::translate_list();
		$site_list = [];
		$language  = array_column($list, 'language');
		$language  = array_filter($language);
		$language  = array_unique($language);
		$language  = array_flip($language);
		$language  = array_map(function(){return [];}, $language);

		$get       = \dash\request::get();
		$getTrans  = isset($get['t']) ? $get['t'] : '';
		$getTrans  = explode('-', $getTrans);
		$getTrans  = array_filter($getTrans);
		$getTrans  = array_unique($getTrans);

		foreach ($list as $key => $value)
		{
			$thisTransKey = $value['language']. $value['index'];
			if(!in_array($thisTransKey, $getTrans))
			{
				$getTrans[] = $thisTransKey;
			}

			$get['t']                       = implode('-', $getTrans);
			$url                            = \dash\url::that(). '?'. http_build_query($get);
			$value['url']                   = $url;
			$language[$value['language']][] = $value;

		}

		return $site_list;

	}

	public static function translate_list()
	{
		$translate =
		[

			'am_sadiq'           => [ 'id' => 1, 'index' => 1, 'language' => 'am', 'name' => 'sadiq', 'localname' => 'sadiq', 'table_name' => 'am_sadiq', 'flag' => 'et', 'language_name' => 'Amharic', 'local_name' => 'ሳዲቅ ሳኒ ሐቢብ', 'ename' => 'Muhammed Sadiq and Muhammed Sani Habib', ],
			'ar_jalalayn'        => [ 'id' => 2, 'index' => 1, 'language' => 'ar', 'name' => 'jalalayn', 'localname' => 'jalalayn', 'table_name' => 'ar_jalalayn', 'flag' => 'sa', 'language_name' => 'Arabic', 'local_name' => 'تفسير الجلالين', 'ename' => 'Jalal ad-Din al-Mahalli and Jalal ad-Din as-Suyuti', ],
			'ar_muyassar'        => [ 'id' => 3, 'index' => 2, 'language' => 'ar', 'name' => 'muyassar', 'localname' => 'muyassar', 'table_name' => 'ar_muyassar', 'flag' => 'sa', 'language_name' => 'Arabic', 'local_name' => 'تفسير المیسر', 'ename' => 'King Fahad Quran Complex', ],
			'az_mammadaliyev'    => [ 'id' => 4, 'index' => 1, 'language' => 'az', 'name' => 'mammadaliyev', 'localname' => 'mammadaliyev', 'table_name' => 'az_mammadaliyev', 'flag' => 'az', 'language_name' => 'Azerbaijani', 'local_name' => 'Məmmədəliyev Bünyadov', 'ename' => 'Vasim Mammadaliyev and Ziya Bunyadov', ],
			'az_musayev'         => [ 'id' => 5, 'index' => 2, 'language' => 'az', 'name' => 'musayev', 'localname' => 'musayev', 'table_name' => 'az_musayev', 'flag' => 'az', 'language_name' => 'Azerbaijani', 'local_name' => 'Musayev', 'ename' => 'Alikhan Musayev', ],
			'be_mensur'          => [ 'id' => 6, 'index' => 1, 'language' => 'be', 'name' => 'mensur', 'localname' => 'mensur', 'table_name' => 'be_mensur', 'flag' => 'dz', 'language_name' => 'Amazigh', 'local_name' => 'At Mensur', 'ename' => 'Ramdane At Mansour', ],
			'bg_theophanov'      => [ 'id' => 7, 'index' => 1, 'language' => 'bg', 'name' => 'theophanov', 'localname' => 'theophanov', 'table_name' => 'bg_theophanov', 'flag' => 'bg', 'language_name' => 'Bulgarian', 'local_name' => 'Теофанов', 'ename' => 'Tzvetan Theophanov', ],
			'bn_bengali'         => [ 'id' => 8, 'index' => 1, 'language' => 'bn', 'name' => 'bengali', 'localname' => 'bengali', 'table_name' => 'bn_bengali', 'flag' => 'bd', 'language_name' => 'Bengali', 'local_name' => 'মুহিউদ্দীন খান', 'ename' => 'Muhiuddin Khan', ],
			'bn_hoque'           => [ 'id' => 9, 'index' => 2, 'language' => 'bn', 'name' => 'hoque', 'localname' => 'hoque', 'table_name' => 'bn_hoque', 'flag' => 'bd', 'language_name' => 'Bengali', 'local_name' => 'জহুরুল হক', 'ename' => 'Zohurul Hoque', ],
			'bs_korkut'          => [ 'id' => 10, 'index' => 1, 'language' => 'bs', 'name' => 'korkut', 'localname' => 'korkut', 'table_name' => 'bs_korkut', 'flag' => 'ba', 'language_name' => 'Bosnian', 'local_name' => 'Korkut', 'ename' => 'Besim Korkut', ],
			'bs_mlivo'           => [ 'id' => 11, 'index' => 2, 'language' => 'bs', 'name' => 'mlivo', 'localname' => 'mlivo', 'table_name' => 'bs_mlivo', 'flag' => 'ba', 'language_name' => 'Bosnian', 'local_name' => 'Mlivo', 'ename' => 'Mustafa Mlivo', ],
			'cs_hrbek'           => [ 'id' => 12, 'index' => 1, 'language' => 'cs', 'name' => 'hrbek', 'localname' => 'hrbek', 'table_name' => 'cs_hrbek', 'flag' => 'cz', 'language_name' => 'Czech', 'local_name' => 'Hrbek', 'ename' => 'Preklad I. Hrbek', ],
			'cs_nykl'            => [ 'id' => 13, 'index' => 2, 'language' => 'cs', 'name' => 'nykl', 'localname' => 'nykl', 'table_name' => 'cs_nykl', 'flag' => 'cz', 'language_name' => 'Czech', 'local_name' => 'Nykl', 'ename' => 'A. R. Nykl', ],
			'de_aburida'         => [ 'id' => 14, 'index' => 1, 'language' => 'de', 'name' => 'aburida', 'localname' => 'aburida', 'table_name' => 'de_aburida', 'flag' => 'de', 'language_name' => 'German', 'local_name' => 'Abu Rida', 'ename' => 'Abu Rida Muhammad ibn Ahmad ibn Rassoul', ],
			'de_bubenheim'       => [ 'id' => 15, 'index' => 2, 'language' => 'de', 'name' => 'bubenheim', 'localname' => 'bubenheim', 'table_name' => 'de_bubenheim', 'flag' => 'de', 'language_name' => 'German', 'local_name' => 'Bubenheim Elyas', 'ename' => 'A. S. F. Bubenheim and N. Elyas', ],
			'de_khoury'          => [ 'id' => 16, 'index' => 3, 'language' => 'de', 'name' => 'khoury', 'localname' => 'khoury', 'table_name' => 'de_khoury', 'flag' => 'de', 'language_name' => 'German', 'local_name' => 'Khoury', 'ename' => 'Adel Theodor Khoury', ],
			'de_zaidan'          => [ 'id' => 17, 'index' => 4, 'language' => 'de', 'name' => 'zaidan', 'localname' => 'zaidan', 'table_name' => 'de_zaidan', 'flag' => 'de', 'language_name' => 'German', 'local_name' => 'Zaidan', 'ename' => 'Amir Zaidan', ],
			'dv_divehi'          => [ 'id' => 18, 'index' => 1, 'language' => 'dv', 'name' => 'divehi', 'localname' => 'divehi', 'table_name' => 'dv_divehi', 'flag' => 'mv', 'language_name' => 'Divehi', 'local_name' => 'ދިވެހި', 'ename' => 'Office of the President of Maldives', ],
			'en_ahmedali'        => [ 'id' => 19, 'index' => 1, 'language' => 'en', 'name' => 'ahmedali', 'localname' => 'ahmedali', 'table_name' => 'en_ahmedali', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Ahmed Ali', 'ename' => 'Ahmed Ali', ],
			'en_ahmedraza'       => [ 'id' => 20, 'index' => 2, 'language' => 'en', 'name' => 'ahmedraza', 'localname' => 'ahmedraza', 'table_name' => 'en_ahmedraza', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Ahmed Raza Khan', 'ename' => 'Ahmed Raza Khan', ],
			'en_arberry'         => [ 'id' => 21, 'index' => 3, 'language' => 'en', 'name' => 'arberry', 'localname' => 'arberry', 'table_name' => 'en_arberry', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Arberry', 'ename' => 'A. J. Arberry', ],
			'en_daryabadi'       => [ 'id' => 22, 'index' => 4, 'language' => 'en', 'name' => 'daryabadi', 'localname' => 'daryabadi', 'table_name' => 'en_daryabadi', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Daryabadi', 'ename' => 'Abdul Majid Daryabadi', ],
			'en_hilali'          => [ 'id' => 23, 'index' => 5, 'language' => 'en', 'name' => 'hilali', 'localname' => 'hilali', 'table_name' => 'en_hilali', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Hilali Khan', 'ename' => 'Muhammad Taqi-ud-Din al-Hilali and Muhammad Muhsin Khan', ],
			'en_itani'           => [ 'id' => 24, 'index' => 6, 'language' => 'en', 'name' => 'itani', 'localname' => 'itani', 'table_name' => 'en_itani', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Itani', 'ename' => 'Talal Itani', ],
			'en_maududi'         => [ 'id' => 25, 'index' => 7, 'language' => 'en', 'name' => 'maududi', 'localname' => 'maududi', 'table_name' => 'en_maududi', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Maududi', 'ename' => 'Abul Ala Maududi', ],
			'en_mubarakpuri'     => [ 'id' => 26, 'index' => 8, 'language' => 'en', 'name' => 'mubarakpuri', 'localname' => 'mubarakpuri', 'table_name' => 'en_mubarakpuri', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Mubarakpuri', 'ename' => 'Safi-ur-Rahman al-Mubarakpuri', ],
			'en_pickthall'       => [ 'id' => 27, 'index' => 9, 'language' => 'en', 'name' => 'pickthall', 'localname' => 'pickthall', 'table_name' => 'en_pickthall', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Pickthall', 'ename' => 'Mohammed Marmaduke William Pickthall', ],
			'en_qarai'           => [ 'id' => 28, 'index' => 10, 'language' => 'en', 'name' => 'qarai', 'localname' => 'qarai', 'table_name' => 'en_qarai', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Qarai', 'ename' => 'Ali Quli Qarai', ],
			'en_qaribullah'      => [ 'id' => 29, 'index' => 11, 'language' => 'en', 'name' => 'qaribullah', 'localname' => 'qaribullah', 'table_name' => 'en_qaribullah', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Qaribullah Darwish', 'ename' => 'Hasan al-Fatih Qaribullah and Ahmad Darwish', ],
			'en_sahih'           => [ 'id' => 30, 'index' => 12, 'language' => 'en', 'name' => 'sahih', 'localname' => 'sahih', 'table_name' => 'en_sahih', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Saheeh International', 'ename' => 'Saheeh International', ],
			'en_sarwar'          => [ 'id' => 31, 'index' => 13, 'language' => 'en', 'name' => 'sarwar', 'localname' => 'sarwar', 'table_name' => 'en_sarwar', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Sarwar', 'ename' => 'Muhammad Sarwar', ],
			'en_shakir'          => [ 'id' => 32, 'index' => 14, 'language' => 'en', 'name' => 'shakir', 'localname' => 'shakir', 'table_name' => 'en_shakir', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Shakir', 'ename' => 'Mohammad Habib Shakir', ],
			'en_transliteration' => [ 'id' => 33, 'index' => 15, 'language' => 'en', 'name' => 'transliteration', 'localname' => 'transliteration', 'table_name' => 'en_transliteration', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Transliteration', 'ename' => 'English Transliteration', ],
			'en_wahiduddin'      => [ 'id' => 34, 'index' => 16, 'language' => 'en', 'name' => 'wahiduddin', 'localname' => 'wahiduddin', 'table_name' => 'en_wahiduddin', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Wahiduddin Khan', 'ename' => 'Wahiduddin Khan', ],
			'en_yusufali'        => [ 'id' => 35, 'index' => 17, 'language' => 'en', 'name' => 'yusufali', 'localname' => 'yusufali', 'table_name' => 'en_yusufali', 'flag' => 'us', 'language_name' => 'English', 'local_name' => 'Yusuf Ali', 'ename' => 'Abdullah Yusuf Ali', ],
			'es_bornez'          => [ 'id' => 36, 'index' => 1, 'language' => 'es', 'name' => 'bornez', 'localname' => 'bornez', 'table_name' => 'es_bornez', 'flag' => 'es', 'language_name' => 'Spanish', 'local_name' => 'Bornez', 'ename' => 'Raúl González Bórnez', ],
			'es_cortes'          => [ 'id' => 37, 'index' => 2, 'language' => 'es', 'name' => 'cortes', 'localname' => 'cortes', 'table_name' => 'es_cortes', 'flag' => 'es', 'language_name' => 'Spanish', 'local_name' => 'Cortes', 'ename' => 'Julio Cortes ', ],
			'es_garcia'          => [ 'id' => 38, 'index' => 3, 'language' => 'es', 'name' => 'garcia', 'localname' => 'garcia', 'table_name' => 'es_garcia', 'flag' => 'es', 'language_name' => 'Spanish', 'local_name' => 'Garcia', 'ename' => 'Muhammad Isa García', ],
			'fa_ansarian'        => [ 'id' => 39, 'index' => 1, 'language' => 'fa', 'name' => 'ansarian', 'localname' => 'انصاریان', 'table_name' => 'fa_ansarian', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'انصاریان', 'ename' => 'Hussain Ansarian', ],
			'fa_ayati'           => [ 'id' => 40, 'index' => 2, 'language' => 'fa', 'name' => 'ayati', 'localname' => 'آیتی', 'table_name' => 'fa_ayati', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'آیتی', 'ename' => 'AbdolMohammad Ayati', ],
			'fa_bahrampour'      => [ 'id' => 41, 'index' => 3, 'language' => 'fa', 'name' => 'bahrampour', 'localname' => 'بهرام‌پور', 'table_name' => 'fa_bahrampour', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'بهرام پور', 'ename' => 'Abolfazl Bahrampour', ],
			'fa_fooladvand'      => [ 'id' => 42, 'index' => 4, 'language' => 'fa', 'name' => 'fooladvand', 'localname' => 'فولادوند', 'table_name' => 'fa_fooladvand', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'فولادوند', 'ename' => 'Mohammad Mahdi Fooladvand', ],
			'fa_gharaati'        => [ 'id' => 43, 'index' => 5, 'language' => 'fa', 'name' => 'gharaati', 'localname' => 'قرائتی', 'table_name' => 'fa_gharaati', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'قرائتی', 'ename' => 'Mohsen Gharaati', ],
			'fa_ghomshei'        => [ 'id' => 44, 'index' => 6, 'language' => 'fa', 'name' => 'ghomshei', 'localname' => 'قمشه‌ای', 'table_name' => 'fa_ghomshei', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'الهی قمشه ای', 'ename' => 'Mahdi Elahi Ghomshei', ],
			'fa_khorramdel'      => [ 'id' => 45, 'index' => 7, 'language' => 'fa', 'name' => 'khorramdel', 'localname' => 'خرم‌دل', 'table_name' => 'fa_khorramdel', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'خرمدل', 'ename' => 'Mostafa Khorramdel', ],
			'fa_khorramshahi'    => [ 'id' => 46, 'index' => 8, 'language' => 'fa', 'name' => 'khorramshahi', 'localname' => 'خرم‌شاهی', 'table_name' => 'fa_khorramshahi', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'خرمشاهی', 'ename' => 'Baha\'oddin Khorramshahi', ],
			'fa_makarem'         => [ 'id' => 47, 'index' => 9, 'language' => 'fa', 'name' => 'makarem', 'localname' => 'مکارم', 'table_name' => 'fa_makarem', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'مکارم شیرازی', 'ename' => 'Naser Makarem Shirazi', ],
			'fa_moezzi'          => [ 'id' => 48, 'index' => 10, 'language' => 'fa', 'name' => 'moezzi', 'localname' => 'معزی', 'table_name' => 'fa_moezzi', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'معزی', 'ename' => 'Mohammad Kazem Moezzi', ],
			'fa_mojtabavi'       => [ 'id' => 49, 'index' => 11, 'language' => 'fa', 'name' => 'mojtabavi', 'localname' => 'مجتبوی', 'table_name' => 'fa_mojtabavi', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'مجتبوی', 'ename' => 'Sayyed Jalaloddin Mojtabavi', ],
			'fa_sadeqi'          => [ 'id' => 50, 'index' => 12, 'language' => 'fa', 'name' => 'sadeqi', 'localname' => 'صادقی', 'table_name' => 'fa_sadeqi', 'flag' => 'ir', 'language_name' => 'Persian', 'local_name' => 'صادقی تهرانی', 'ename' => 'Mohammad Sadeqi Tehrani', ],
			'fr_hamidullah'      => [ 'id' => 51, 'index' => 1, 'language' => 'fr', 'name' => 'hamidullah', 'localname' => 'hamidullah', 'table_name' => 'fr_hamidullah', 'flag' => 'fr', 'language_name' => 'French', 'local_name' => 'Hamidullah', 'ename' => 'Muhammad Hamidullah', ],
			'ha_gumi'            => [ 'id' => 52, 'index' => 1, 'language' => 'ha', 'name' => 'gumi', 'localname' => 'gumi', 'table_name' => 'ha_gumi', 'flag' => 'ng', 'language_name' => 'Hausa', 'local_name' => 'Gumi', 'ename' => 'Abubakar Mahmoud Gumi', ],
			'hi_farooq'          => [ 'id' => 53, 'index' => 1, 'language' => 'hi', 'name' => 'farooq', 'localname' => 'farooq', 'table_name' => 'hi_farooq', 'flag' => 'in', 'language_name' => 'Hindi', 'local_name' => 'फ़ारूक़ ख़ान अहमद', 'ename' => 'Muhammad Farooq Khan and Muhammad Ahmed ', ],
			'hi_hindi'           => [ 'id' => 54, 'index' => 2, 'language' => 'hi', 'name' => 'hindi', 'localname' => 'hindi', 'table_name' => 'hi_hindi', 'flag' => 'in', 'language_name' => 'Hindi', 'local_name' => 'फ़ारूक़ ख़ान नदवी', 'ename' => 'Suhel Farooq Khan and Saifur Rahman Nadwi', ],
			'id_indonesian'      => [ 'id' => 55, 'index' => 1, 'language' => 'id', 'name' => 'indonesian', 'localname' => 'indonesian', 'table_name' => 'id_indonesian', 'flag' => 'id', 'language_name' => 'Indonesian', 'local_name' => 'Bahasa Indonesia', 'ename' => 'Indonesian Ministry of Religious Affairs', ],
			'id_jalalayn'        => [ 'id' => 56, 'index' => 2, 'language' => 'id', 'name' => 'jalalayn', 'localname' => 'jalalayn', 'table_name' => 'id_jalalayn', 'flag' => 'id', 'language_name' => 'Indonesian', 'local_name' => 'Tafsir Jalalayn', 'ename' => 'Jalal ad-Din al-Mahalli and Jalal ad-Din as-Suyuti', ],
			'id_muntakhab'       => [ 'id' => 57, 'index' => 3, 'language' => 'id', 'name' => 'muntakhab', 'localname' => 'muntakhab', 'table_name' => 'id_muntakhab', 'flag' => 'id', 'language_name' => 'Indonesian', 'local_name' => 'Quraish Shihab', 'ename' => 'Muhammad Quraish Shihab et al.', ],
			'it_piccardo'        => [ 'id' => 58, 'index' => 1, 'language' => 'it', 'name' => 'piccardo', 'localname' => 'piccardo', 'table_name' => 'it_piccardo', 'flag' => 'it', 'language_name' => 'Italian', 'local_name' => 'Piccardo', 'ename' => 'Hamza Roberto Piccardo', ],
			'ja_japanese'        => [ 'id' => 59, 'index' => 1, 'language' => 'ja', 'name' => 'japanese', 'localname' => 'japanese', 'table_name' => 'ja_japanese', 'flag' => 'jp', 'language_name' => 'Japanese', 'local_name' => 'Japanese', 'ename' => 'Unknown', ],
			'ko_korean'          => [ 'id' => 60, 'index' => 1, 'language' => 'ko', 'name' => 'korean', 'localname' => 'korean', 'table_name' => 'ko_korean', 'flag' => 'kr', 'language_name' => 'Korean', 'local_name' => 'Korean', 'ename' => 'Unknown', ],
			'ku_asan'            => [ 'id' => 61, 'index' => 1, 'language' => 'ku', 'name' => 'asan', 'localname' => 'asan', 'table_name' => 'ku_asan', 'flag' => 'iq', 'language_name' => 'Kurdish', 'local_name' => 'ته فسیری ئاسان', 'ename' => 'Burhan Muhammad-Amin', ],
			'ml_abdulhameed'     => [ 'id' => 62, 'index' => 1, 'language' => 'ml', 'name' => 'abdulhameed', 'localname' => 'abdulhameed', 'table_name' => 'ml_abdulhameed', 'flag' => 'in', 'language_name' => 'Malayalam', 'local_name' => 'അബ്ദുല്‍ ഹമീദ് പറപ്പൂര്‍, ', 'ename' => 'Cheriyamundam Abdul Hameed and Kunhi Mohammed Parappoor', ],
			'ml_karakunnu'       => [ 'id' => 63, 'index' => 2, 'language' => 'ml', 'name' => 'karakunnu', 'localname' => 'karakunnu', 'table_name' => 'ml_karakunnu', 'flag' => 'in', 'language_name' => 'Malayalam', 'local_name' => 'കാരകുന്ന് എളയാവൂര്', 'ename' => 'Muhammad Karakunnu and Vanidas Elayavoor', ],
			'ms_basmeih'         => [ 'id' => 64, 'index' => 1, 'language' => 'ms', 'name' => 'basmeih', 'localname' => 'basmeih', 'table_name' => 'ms_basmeih', 'flag' => 'my', 'language_name' => 'Malay', 'local_name' => 'Basmeih', 'ename' => 'Abdullah Muhammad Basmeih', ],
			'nl_keyzer'          => [ 'id' => 65, 'index' => 1, 'language' => 'nl', 'name' => 'keyzer', 'localname' => 'keyzer', 'table_name' => 'nl_keyzer', 'flag' => 'nl', 'language_name' => 'Dutch', 'local_name' => 'Keyzer', 'ename' => 'Salomo Keyzer ', ],
			'nl_leemhuis'        => [ 'id' => 66, 'index' => 2, 'language' => 'nl', 'name' => 'leemhuis', 'localname' => 'leemhuis', 'table_name' => 'nl_leemhuis', 'flag' => 'nl', 'language_name' => 'Dutch', 'local_name' => 'Leemhuis', 'ename' => 'Fred Leemhuis', ],
			'nl_siregar'         => [ 'id' => 67, 'index' => 3, 'language' => 'nl', 'name' => 'siregar', 'localname' => 'siregar', 'table_name' => 'nl_siregar', 'flag' => 'nl', 'language_name' => 'Dutch', 'local_name' => 'Siregar', 'ename' => 'Sofian S. Siregar', ],
			'no_berg'            => [ 'id' => 68, 'index' => 1, 'language' => 'no', 'name' => 'berg', 'localname' => 'berg', 'table_name' => 'no_berg', 'flag' => 'no', 'language_name' => 'Norwegian', 'local_name' => 'Einar Berg', 'ename' => 'Einar Berg', ],
			'pl_bielawskiego'    => [ 'id' => 69, 'index' => 1, 'language' => 'pl', 'name' => 'bielawskiego', 'localname' => 'bielawskiego', 'table_name' => 'pl_bielawskiego', 'flag' => 'pl', 'language_name' => 'Polish', 'local_name' => 'Bielawskiego', 'ename' => 'Józefa Bielawskiego', ],
			'ps_abdulwali'       => [ 'id' => 70, 'index' => 1, 'language' => 'ps', 'name' => 'abdulwali', 'localname' => 'abdulwali', 'table_name' => 'ps_abdulwali', 'flag' => 'af', 'language_name' => 'Pashto', 'local_name' => 'عبدالولي', 'ename' => 'Abdulwali Khan', ],
			'pt_elhayek'         => [ 'id' => 71, 'index' => 1, 'language' => 'pt', 'name' => 'elhayek', 'localname' => 'elhayek', 'table_name' => 'pt_elhayek', 'flag' => 'pt', 'language_name' => 'Portuguese', 'local_name' => 'El-Hayek', 'ename' => 'Samir El-Hayek ', ],
			'ro_grigore'         => [ 'id' => 72, 'index' => 1, 'language' => 'ro', 'name' => 'grigore', 'localname' => 'grigore', 'table_name' => 'ro_grigore', 'flag' => 'ro', 'language_name' => 'Romanian', 'local_name' => 'Grigore', 'ename' => 'George Grigore', ],
			'ru_abuadel'         => [ 'id' => 73, 'index' => 1, 'language' => 'ru', 'name' => 'abuadel', 'localname' => 'abuadel', 'table_name' => 'ru_abuadel', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Абу Адель', 'ename' => 'Abu Adel', ],
			'ru_krachkovsky'     => [ 'id' => 74, 'index' => 2, 'language' => 'ru', 'name' => 'krachkovsky', 'localname' => 'krachkovsky', 'table_name' => 'ru_krachkovsky', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Крачковский', 'ename' => 'Ignaty Yulianovich Krachkovsky', ],
			'ru_kuliev'          => [ 'id' => 75, 'index' => 3, 'language' => 'ru', 'name' => 'kuliev', 'localname' => 'kuliev', 'table_name' => 'ru_kuliev', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Кулиев', 'ename' => 'Elmir Kuliev', ],
			'ru_kuliev-alsaadi'  => [ 'id' => 76, 'index' => 4, 'language' => 'ru', 'name' => 'kuliev', 'localname' => 'kuliev', 'table_name' => 'ru_kuliev-alsaadi', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Кулиев + ас-Саади', 'ename' => 'Elmir Kuliev (with Abd ar-Rahman as-Saadi\'s commentaries)', ],
			'ru_muntahab'        => [ 'id' => 77, 'index' => 4, 'language' => 'ru', 'name' => 'muntahab', 'localname' => 'muntahab', 'table_name' => 'ru_muntahab', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Аль-Мунтахаб', 'ename' => 'Ministry of Awqaf, Egypt', ],
			'ru_osmanov'         => [ 'id' => 78, 'index' => 5, 'language' => 'ru', 'name' => 'osmanov', 'localname' => 'osmanov', 'table_name' => 'ru_osmanov', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Османов', 'ename' => 'Magomed-Nuri Osmanovich Osmanov', ],
			'ru_porokhova'       => [ 'id' => 79, 'index' => 6, 'language' => 'ru', 'name' => 'porokhova', 'localname' => 'porokhova', 'table_name' => 'ru_porokhova', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Порохова', 'ename' => 'V. Porokhova', ],
			'ru_sablukov'        => [ 'id' => 80, 'index' => 7, 'language' => 'ru', 'name' => 'sablukov', 'localname' => 'sablukov', 'table_name' => 'ru_sablukov', 'flag' => 'ru', 'language_name' => 'Russian', 'local_name' => 'Саблуков', 'ename' => 'Gordy Semyonovich Sablukov', ],
			'sd_amroti'          => [ 'id' => 81, 'index' => 1, 'language' => 'sd', 'name' => 'amroti', 'localname' => 'amroti', 'table_name' => 'sd_amroti', 'flag' => 'pk', 'language_name' => 'Sindhi', 'local_name' => 'امروٽي', 'ename' => 'Taj Mehmood Amroti', ],
			'so_abduh'           => [ 'id' => 82, 'index' => 1, 'language' => 'so', 'name' => 'abduh', 'localname' => 'abduh', 'table_name' => 'so_abduh', 'flag' => 'so', 'language_name' => 'Somali', 'local_name' => 'Abduh', 'ename' => 'Mahmud Muhammad Abduh', ],
			'sq_ahmeti'          => [ 'id' => 83, 'index' => 1, 'language' => 'sq', 'name' => 'ahmeti', 'localname' => 'ahmeti', 'table_name' => 'sq_ahmeti', 'flag' => 'al', 'language_name' => 'Albanian', 'local_name' => 'Sherif Ahmeti', 'ename' => 'Sherif Ahmeti', ],
			'sq_mehdiu'          => [ 'id' => 84, 'index' => 2, 'language' => 'sq', 'name' => 'mehdiu', 'localname' => 'mehdiu', 'table_name' => 'sq_mehdiu', 'flag' => 'al', 'language_name' => 'Albanian', 'local_name' => 'Feti Mehdiu', 'ename' => 'Feti Mehdiu', ],
			'sq_nahi'            => [ 'id' => 85, 'index' => 3, 'language' => 'sq', 'name' => 'nahi', 'localname' => 'nahi', 'table_name' => 'sq_nahi', 'flag' => 'al', 'language_name' => 'Albanian', 'local_name' => 'Efendi Nahi', 'ename' => 'Hasan Efendi Nahi', ],
			'sv_bernstrom'       => [ 'id' => 86, 'index' => 1, 'language' => 'sv', 'name' => 'bernstrom', 'localname' => 'bernstrom', 'table_name' => 'sv_bernstrom', 'flag' => 'se', 'language_name' => 'Swedish', 'local_name' => 'Bernström', 'ename' => 'Knut Bernström', ],
			'sw_barwani'         => [ 'id' => 87, 'index' => 1, 'language' => 'sw', 'name' => 'barwani', 'localname' => 'barwani', 'table_name' => 'sw_barwani', 'flag' => 'ke', 'language_name' => 'Swahili', 'local_name' => 'Al-Barwani', 'ename' => 'Ali Muhsin Al-Barwani', ],
			'ta_tamil'           => [ 'id' => 88, 'index' => 1, 'language' => 'ta', 'name' => 'tamil', 'localname' => 'tamil', 'table_name' => 'ta_tamil', 'flag' => 'in', 'language_name' => 'Tamil', 'local_name' => 'ஜான் டிரஸ்ட்', 'ename' => 'Jan Turst Foundation', ],
			'tg_ayati'           => [ 'id' => 89, 'index' => 1, 'language' => 'tg', 'name' => 'ayati', 'localname' => 'ayati', 'table_name' => 'tg_ayati', 'flag' => 'tj', 'language_name' => 'Tajik', 'local_name' => 'Оятӣ', 'ename' => 'AbdolMohammad Ayati', ],
			'th_thai'            => [ 'id' => 90, 'index' => 1, 'language' => 'th', 'name' => 'thai', 'localname' => 'thai', 'table_name' => 'th_thai', 'flag' => 'th', 'language_name' => 'Thai', 'local_name' => 'ภาษาไทย', 'ename' => 'King Fahad Quran Complex', ],
			'tr_ates'            => [ 'id' => 91, 'index' => 1, 'language' => 'tr', 'name' => 'ates', 'localname' => 'ates', 'table_name' => 'tr_ates', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Süleyman Ateş', 'ename' => 'Suleyman Ates', ],
			'tr_bulac'           => [ 'id' => 92, 'index' => 2, 'language' => 'tr', 'name' => 'bulac', 'localname' => 'bulac', 'table_name' => 'tr_bulac', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Alİ Bulaç', 'ename' => 'Alİ Bulaç', ],
			'tr_diyanet'         => [ 'id' => 93, 'index' => 3, 'language' => 'tr', 'name' => 'diyanet', 'localname' => 'diyanet', 'table_name' => 'tr_diyanet', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Diyanet İşleri', 'ename' => 'Diyanet Isleri', ],
			'tr_golpinarli'      => [ 'id' => 94, 'index' => 4, 'language' => 'tr', 'name' => 'golpinarli', 'localname' => 'golpinarli', 'table_name' => 'tr_golpinarli', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Abdulbakî Gölpınarlı', 'ename' => 'Abdulbaki Golpinarli', ],
			'tr_ozturk'          => [ 'id' => 95, 'index' => 5, 'language' => 'tr', 'name' => 'ozturk', 'localname' => 'ozturk', 'table_name' => 'tr_ozturk', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Öztürk', 'ename' => 'Yasar Nuri Ozturk', ],
			'tr_transliteration' => [ 'id' => 96, 'index' => 6, 'language' => 'tr', 'name' => 'transliteration', 'localname' => 'transliteration', 'table_name' => 'tr_transliteration', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Çeviriyazı', 'ename' => 'Muhammet Abay', ],
			'tr_vakfi'           => [ 'id' => 97, 'index' => 7, 'language' => 'tr', 'name' => 'vakfi', 'localname' => 'vakfi', 'table_name' => 'tr_vakfi', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Diyanet Vakfı', 'ename' => 'Diyanet Vakfi', ],
			'tr_yazir'           => [ 'id' => 98, 'index' => 8, 'language' => 'tr', 'name' => 'yazir', 'localname' => 'yazir', 'table_name' => 'tr_yazir', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Elmalılı Hamdi Yazır', 'ename' => 'Elmalili Hamdi Yazir', ],
			'tr_yildirim'        => [ 'id' => 99, 'index' => 9, 'language' => 'tr', 'name' => 'yildirim', 'localname' => 'yildirim', 'table_name' => 'tr_yildirim', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Suat Yıldırım', 'ename' => 'Suat Yildirim', ],
			'tr_yuksel'          => [ 'id' => 100, 'index' => 10, 'language' => 'tr', 'name' => 'yuksel', 'localname' => 'yuksel', 'table_name' => 'tr_yuksel', 'flag' => 'tr', 'language_name' => 'Turkish', 'local_name' => 'Edip Yüksel', 'ename' => 'Edip Yüksel', ],
			'tt_nugman'          => [ 'id' => 101, 'index' => 1, 'language' => 'tt', 'name' => 'nugman', 'localname' => 'nugman', 'table_name' => 'tt_nugman', 'flag' => 'ru', 'language_name' => 'Tatar', 'local_name' => 'Yakub Ibn Nugman', 'ename' => 'Yakub Ibn Nugman', ],
			'ug_saleh'           => [ 'id' => 102, 'index' => 1, 'language' => 'ug', 'name' => 'saleh', 'localname' => 'saleh', 'table_name' => 'ug_saleh', 'flag' => 'cn', 'language_name' => 'Uyghur', 'local_name' => 'محمد صالح', 'ename' => 'Muhammad Saleh', ],
			'ur_ahmedali'        => [ 'id' => 103, 'index' => 1, 'language' => 'ur', 'name' => 'ahmedali', 'localname' => 'ahmedali', 'table_name' => 'ur_ahmedali', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'احمد علی', 'ename' => 'Ahmed Ali', ],
			'ur_jalandhry'       => [ 'id' => 104, 'index' => 2, 'language' => 'ur', 'name' => 'jalandhry', 'localname' => 'jalandhry', 'table_name' => 'ur_jalandhry', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'جالندہری', 'ename' => 'Fateh Muhammad Jalandhry', ],
			'ur_jawadi'          => [ 'id' => 105, 'index' => 3, 'language' => 'ur', 'name' => 'jawadi', 'localname' => 'jawadi', 'table_name' => 'ur_jawadi', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'علامہ جوادی', 'ename' => 'Syed Zeeshan Haider Jawadi', ],
			'ur_junagarhi'       => [ 'id' => 106, 'index' => 4, 'language' => 'ur', 'name' => 'junagarhi', 'localname' => 'junagarhi', 'table_name' => 'ur_junagarhi', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'محمد جوناگڑھی', 'ename' => 'Muhammad Junagarhi', ],
			'ur_kanzuliman'      => [ 'id' => 107, 'index' => 5, 'language' => 'ur', 'name' => 'kanzuliman', 'localname' => 'kanzuliman', 'table_name' => 'ur_kanzuliman', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'احمد رضا خان', 'ename' => 'Ahmed Raza Khan', ],
			'ur_maududi'         => [ 'id' => 108, 'index' => 6, 'language' => 'ur', 'name' => 'maududi', 'localname' => 'maududi', 'table_name' => 'ur_maududi', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'ابوالاعلی مودودی', 'ename' => 'Abul A\'ala Maududi', ],
			'ur_najafi'          => [ 'id' => 109, 'index' => 7, 'language' => 'ur', 'name' => 'najafi', 'localname' => 'najafi', 'table_name' => 'ur_najafi', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'محمد حسین نجفی', 'ename' => 'Muhammad Hussain Najafi ', ],
			'ur_qadri'           => [ 'id' => 110, 'index' => 8, 'language' => 'ur', 'name' => 'qadri', 'localname' => 'qadri', 'table_name' => 'ur_qadri', 'flag' => 'pk', 'language_name' => 'Urdu', 'local_name' => 'طاہر القادری', 'ename' => 'Tahir ul Qadri', ],
			'uz_sodik'           => [ 'id' => 111, 'index' => 1, 'language' => 'uz', 'name' => 'sodik', 'localname' => 'sodik', 'table_name' => 'uz_sodik', 'flag' => 'uz', 'language_name' => 'Uzbek', 'local_name' => 'Мухаммад Содик', 'ename' => 'Muhammad Sodik Muhammad Yusuf', ],
			'zh_jian'            => [ 'id' => 112, 'index' => 1, 'language' => 'zh', 'name' => 'jian', 'localname' => 'jian', 'table_name' => 'zh_jian', 'flag' => 'cn', 'language_name' => 'Chinese', 'local_name' => 'Ma Jian', 'ename' => 'Ma Jian', ],
			'zh_majian'          => [ 'id' => 113, 'index' => 2, 'language' => 'zh', 'name' => 'majian', 'localname' => 'majian', 'table_name' => 'zh_majian', 'flag' => 'tw', 'language_name' => 'Chinese', 'local_name' => 'Ma Jian (Traditional)', 'ename' => 'Ma Jian, '],

		];
		return $translate;
	}
}
?>