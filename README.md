
# README de Instalação

## Requisitos

- Sistema operacional: **Ubuntu Server 22.04 LTS**
- Servidor web: **Apache 2**
- Banco de dados: **MySQL**
- PHP (versão compatível com seu projeto)
- Composer (gerenciador de dependências PHP)
- Doctrine ORM (para gerenciamento do banco de dados)

---

## Passo 1: Atualizar o Sistema

```bash
sudo apt update && sudo apt upgrade -y
```

---

## Passo 2: Instalar Apache

```bash
sudo apt install apache2 -y
```

Verifique se o Apache está rodando:

```bash
sudo systemctl status apache2
```

Se não estiver ativo, inicie com:

```bash
sudo systemctl start apache2
```

Ative para iniciar junto com o sistema:

```bash
sudo systemctl enable apache2
```

---

## Passo 3: Instalar MySQL

```bash
sudo apt install mysql-server -y
```

Verifique o status:

```bash
sudo systemctl status mysql
```

Se necessário, inicie e habilite:

```bash
sudo systemctl start mysql
sudo systemctl enable mysql
```

### Configuração inicial do MySQL

```bash
sudo mysql_secure_installation
```

---

## Passo 4: Instalar PHP e Extensões

```bash
sudo apt install php php-cli php-common php-mbstring php-xml php-mysql php-curl php-zip php-intl libapache2-mod-php -y
```

Verifique a versão:

```bash
php -v
```

---

## Passo 5: Configurar Apache para o Projeto

### Criar diretório do projeto:

```bash
sudo mkdir -p /var/www/seu_projeto
sudo chown -R $USER:$USER /var/www/seu_projeto
```

### Criar configuração no Apache:

```bash
sudo nano /etc/apache2/sites-available/seu_projeto.conf
```

Conteúdo sugerido:

```apacheconf
<VirtualHost *:80>
    ServerName seu_dominio_ou_ip

    DocumentRoot /var/www/seu_projeto/public

    <Directory /var/www/seu_projeto/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/seu_projeto_error.log
    CustomLog ${APACHE_LOG_DIR}/seu_projeto_access.log combined
</VirtualHost>
```

### Ativar site e módulo rewrite:

```bash
sudo a2ensite seu_projeto.conf
sudo a2enmod rewrite
```

### Reiniciar Apache:

```bash
sudo systemctl restart apache2
```

---

## Passo 6: Configurar Banco de Dados

### Acessar MySQL:

```bash
sudo mysql -u root -p
```

### Comandos SQL:

```sql
CREATE DATABASE nome_do_banco CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'senha_segura';
GRANT ALL PRIVILEGES ON nome_do_banco.* TO 'usuario'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Exemplo de `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha_segura
```

---

## Passo 7: Instalar Composer

Verifique se está instalado:

```bash
composer -V
```

Se não estiver:

```bash
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

Verifique novamente:

```bash
composer -V
```

---

## Passo 8: Instalar Dependências

```bash
cd /var/www/seu_projeto
composer install
```

---

## Passo 9: Instalar e Migrar Banco com Doctrine

### Criar banco com Doctrine:

```bash
php bin/console doctrine:database:create
```

### Executar migrations:

```bash
php bin/console doctrine:migrations:migrate
```

---

## Passo 10: Ajustar Permissões

```bash
sudo chown -R www-data:www-data /var/www/seu_projeto/var
sudo chown -R www-data:www-data /var/www/seu_projeto/vendor
```

---

## Passo 11: Testar o Projeto

Abra o navegador:

```
http://seu_dominio_ou_ip
```

---

## Dicas Úteis

### Ver logs do Apache:

```bash
sudo tail -f /var/log/apache2/seu_projeto_error.log
```

### Reiniciar o Apache:

```bash
sudo systemctl restart apache2
```
