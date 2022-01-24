# გამოყენების/დეველოპმენტის წესები და რეკომენდაციები


პროგრამის შესახებ
--
 - აპლიკაცია შექმნილია მარტივი როუტინგისთვის, არქიტექტურულ დიზაინ პატერნად არჩეულია MVC, საწყის ეტაპზე view-ს გამოკლებით, 
   თუმცა პროგრამის განვითარება ამ მიმართულებით არ არის გამორიცხული.


------------------------------------------------------------------------------


გამოძახება 
--
- მიმართვა ხდება შემდეგი წესის მიხედვით 1.1.1.1/className/methodName
  აპლიკაცია აკეთებს className.php ფაილის მოძებნას და იქ დეკლარირებული კლასის ინიციალიზაციას, 
  შემდეგ ამ კლასის methodName მეთოდის გამოძახებას.
  აპლიკაციის ყველა გარე მეთოდს პარამეტრები უნდა გადაეცეს POST მასივით.


------------------------------------------------------------------------------

დაბრუნებული პასუხი
--
- თითოეული გარედან გამოძახებადი მეთოდი თავად არის პასუხისმგებელი დასაბრუნებელი მონაცემების ტიპზე და სტრუქტურაზე. მაგ: 1, 0, -1, JSON, XML და სხვა.
- შიდა გამოყენების private მეთოდებიდან პასუხებს არ ვაბრუნებთ აპლიკაციის გარეთ...!

------------------------------------------------------------------------------


ახალი კლასის/კონტროლერის შექმნა
--
- controllers დირექტორიაში ნებისმიერი ახალი php ფაილის დამატების შემთხვევაში, 
  მასში უნდა შეიქმნას კლასი იგივე დასახელებით რა დასახელებაც აქვს php ფაილს.
- controllers დირექტორიაში ნებისმიერი ახალი php ფაილის დამატების შემთხვევაში, 
  უნდა დაემატოს models დირექტორიას იგივე წესით php ფაილი და კლასი _model 
  ტექსტის დამატებით (კლასშის დასახელებაშიც).
- ცალკე models ან controllers დირექტორიაში დამოუკიდებელ ფაილებს არ ვამატებთ! საზიარო ფუნქციონალის შექმნა შესაძლებელია shared დირექტორიაში, 
  php ფაილის და მისი დასახელებით კლასის შექმნით.
  თუ ფუნქციის დამატებაა საჭირო ამისთვის არსებობს shared/functions.php ფაილი, სადაც მსგავს ფუნქციონალის დამატება არის შესაძლებელი.
- ყველა კონტროლერს უნდა ქონდეს _default დასახელებით განსაზღვრული მეთოდი


------------------------------------------------------------------------------

საზიარო ფუნქციები და კლასები
--
- აპლიკაციას აქვს shared დირექტორია, რომელშიც თავმოყრილია ისეთი ფუნქციები და კლასები, 
  რომლებიც შესაძლოა ყველა კონტროლერში და მოდელში იყოს საჭირო, მაგ: ბაზასთან კავშირი, ლოგირების ფუნქციები და ა.შ 


------------------------------------------------------------------------------

შეცდომების მართვა
--
- აპლიკაციაში შეცდომების დაფიქსირებისას დეტალური აღწერა იწერება php_error.log ფაილში
- შეცდომის შემთხვევაში შიდა გამოყენების მეთოდი არ აბრუნებს აპლიკაციის გარეთ პასუხს, 
  ის მიმართავს “გამომძახებელს“ და მას გადაცემს შეცდომის აღწერას ან უბრალოდ მითითებას, რომ დაფიქსირდა შეცდომა.

------------------------------------------------------------------------------

ტექნოლოგიები
--

- აპლიკაციის backend დაწერილია php 8 ვერსიაზე, mysql 8 PDO,  MsSql ვერსია ჯერჯერობით დაზუსტებული არ არის.

------------------------------------------------------------------------------

ავტორ(ებ)ი
--
- ნოდარ მამაცაშვილი 2021 წელი


------------------------------------------------------------------------------









