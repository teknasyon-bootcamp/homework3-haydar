<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */


class Form
{

    // Defines property of Form without any setting
    protected array $fields;


    // That's showing how easy-peasy to define properties in PHP 8
    private function __construct(
        protected string $action,
        protected string $method,
    ) {
    }


    /**
     * @param string $action  
     * @param string $method
     * 
     * @return Form   
     * 
     * Returns a Form with gived parameters
     */
    public static function createForm(string $action, string $method): Form
    {
        return new static($action, $method);
    }

    /**
     * @param string $action
     * 
     * @return Form
     * 
     * Calls createForm function and returns a Post Form
     */
    public static function createPostForm(string $action): Form
    {
        return  self::createForm($action, 'POST');
    }

    /**
     * @param string $action
     * 
     * @return Form
     * 
     * Calls createForm function and returns a Get Form
     */
    public static function createGetForm(string $action): Form
    {
        return  self::createForm($action, 'GET');
    }


    /**
     * @param string $label
     * @param string $name
     * @param string $defaultValue
     * 
     * Adds fields to fields property of this instance
     */
    public function addField(string $label, string $name, string $defaultValue = null): void
    {
        $field = [
            "label" => $label,
            "name"  => $name,
            "value" => $defaultValue,
        ];

        $this->fields[] = $field;
    }


    /**
     * @param string $method 
     * 
     * Change method property of this instance
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }


    //Render this Form elements to HTML 
    public function render(): void
    {
        echo "<form action='$this->action' method='$this->method'>";

        foreach ($this->fields as $field) {
            echo  "\t<label for='" . $field["name"] . "'>" . $field["label"] . "</label>";
            echo "\t<input type='text' name='" . $field["name"] . "' value='" . $field["value"] . "' />";
        }

        echo "\t<button type='submit'>Gönder</button>";
        echo "</form>";
    }
}
