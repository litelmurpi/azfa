# Materi Sistem Operasi Linux - Lanjutan dan Mendalam

## 1. Instalasi Linux & Konfigurasi Dasar

### Instalasi Linux di VirtualBox
- **Persiapan VirtualBox**: Download dan install VirtualBox, alokasi RAM (minimal 2GB), storage (minimal 20GB)
- **Download ISO Linux**: Ubuntu, CentOS, Debian, atau distro lainnya
- **Proses Instalasi**: 
  - Boot dari ISO
  - Partisi disk (root `/`, home `/home`, swap)
  - Konfigurasi user dan password
  - Network configuration
- **Post-Install Verification**: 
  - Login ke sistem
  - Check kernel version: `uname -r`
  - Check system info: `lsb_release -a`

### Perintah Dasar untuk Informasi User
```bash
whoami          # User saat ini
id              # User ID dan Group ID
users           # Daftar user yang login
who             # Detail user yang login
w               # Aktivitas user
last            # History login user
```

### Format Instruksi pada Linux
- **Syntax**: `command [options] [arguments]`
- **Options**: `-` untuk short option, `--` untuk long option
- **Man pages**: `man command` untuk dokumentasi
- **Help**: `command --help` untuk bantuan singkat

### Utilitas Dasar Sistem Operasi
```bash
date            # Tanggal dan waktu sistem
cal             # Kalender
uptime          # Berapa lama sistem berjalan
df -h           # Disk usage
free -h         # Memory usage
lscpu           # Informasi CPU
lsblk           # Block devices
```

---

## 2. Operasi Input/Output Mendalam

### Konsep I/O dan Redirection
- **Standard Input (stdin)**: File descriptor 0, biasanya keyboard
- **Standard Output (stdout)**: File descriptor 1, biasanya layar
- **Standard Error (stderr)**: File descriptor 2, untuk error messages

### Redirection Operators
```bash
command > file           # Redirect stdout ke file (overwrite)
command >> file          # Redirect stdout ke file (append)
command < file           # Input dari file
command 2> file          # Redirect stderr ke file
command 2>&1             # Redirect stderr ke stdout
command &> file          # Redirect both stdout dan stderr
```

### Pipeline dan Filter
```bash
# Basic pipeline
ls -l | grep ".txt"

# Multiple pipeline
cat file.txt | grep "pattern" | sort | uniq

# Useful filters
grep                     # Pattern matching
sort                     # Sort lines
uniq                     # Remove duplicates
wc                       # Word count
head/tail               # First/last lines
cut                     # Extract columns
awk                     # Text processing
sed                     # Stream editor
```

### Here Document
```bash
cat << EOF > file.txt
Line 1
Line 2
EOF

# Dengan variabel
cat << EOL
Current user: $USER
Current directory: $PWD
EOL
```

---

## 3. Manajemen File & Direktori Lanjutan

### Organisasi File System Linux
```
/                    # Root directory
├── bin/            # Essential binaries
├── boot/           # Boot files
├── dev/            # Device files
├── etc/            # Configuration files
├── home/           # User home directories
├── lib/            # Libraries
├── media/          # Removable media
├── mnt/            # Mount points
├── opt/            # Optional software
├── proc/           # Process information
├── root/           # Root user home
├── run/            # Runtime data
├── sbin/           # System binaries
├── srv/            # Service data
├── sys/            # System information
├── tmp/            # Temporary files
├── usr/            # User programs
└── var/            # Variable data
```

### Operasi File dan Direktori
```bash
# Membuat direktori
mkdir -p path/to/directory   # Buat parent directories

# Copy dengan preserve attributes
cp -a source dest           # Archive mode
cp -r source/ dest/         # Recursive

# Move/rename
mv oldname newname
mv file /path/to/destination/

# Remove
rm -rf directory/           # Force recursive remove
rmdir directory/            # Remove empty directory
```

### Hard Link vs Symbolic Link
```bash
# Hard link
ln original_file hard_link
# - Same inode number
# - Can't link directories
# - Can't cross filesystems

# Symbolic link
ln -s original_file sym_link
# - Different inode
# - Can link directories
# - Can cross filesystems
# - Broken if original deleted
```

### Atribut File dan Permissions
```bash
# Permission format: rwxrwxrwx (owner-group-others)
# r=4, w=2, x=1

# Numeric permissions
chmod 755 file              # rwxr-xr-x
chmod 644 file              # rw-r--r--
chmod 600 file              # rw-------

# Symbolic permissions
chmod u+x file              # Add execute for owner
chmod g-w file              # Remove write for group
chmod o=r file              # Set read-only for others

# Change ownership
chown user:group file
chown -R user:group directory/

# Special permissions
chmod u+s file              # SUID bit
chmod g+s directory/        # SGID bit
chmod +t directory/         # Sticky bit
```

---

## 4. Manajemen Proses Lanjutan

### Konsep Proses
- **PID**: Process ID (unique identifier)
- **PPID**: Parent Process ID
- **Process States**: Running, Sleeping, Stopped, Zombie
- **Process Hierarchy**: Parent-child relationships

### Monitoring Proses
```bash
# Static view
ps aux                      # All processes
ps -ef                      # Full format
ps -u username              # User processes

# Dynamic view
top                         # Real-time process monitor
htop                        # Enhanced top
atop                        # Advanced monitoring

# Process tree
pstree                      # Process hierarchy
pstree -p                   # With PID numbers
```

### Kontrol Proses
```bash
# Background/Foreground
command &                   # Run in background
jobs                        # List background jobs
fg %1                       # Bring job to foreground
bg %1                       # Send job to background
nohup command &             # Run immune to hangups

# Killing processes
kill PID                    # Terminate process
kill -9 PID                 # Force kill
killall process_name        # Kill by name
pkill pattern               # Kill by pattern

# Process priority
nice -n 10 command          # Start with priority
renice 10 PID               # Change priority
```

### Signals
```bash
kill -l                     # List all signals
kill -TERM PID              # Graceful termination
kill -KILL PID              # Force termination
kill -STOP PID              # Suspend process
kill -CONT PID              # Resume process
```

---

## 5. Bash Shell & Scripting Mendalam

### Shell Features
```bash
# History
history                     # Command history
!!                          # Last command
!n                          # Command number n
!string                     # Last command starting with string

# Aliases
alias ll='ls -la'
alias grep='grep --color=auto'
unalias ll                  # Remove alias

# Variables
export VAR=value            # Environment variable
echo $VAR                   # Display variable
unset VAR                   # Remove variable
```

### Prompt Customization
```bash
# PS1 variable controls prompt
export PS1='\u@\h:\w\$ '    # user@host:path$
export PS1='\[\e[32m\]\u@\h:\w\$\[\e[0m\] '  # Colored prompt

# Special characters
\u                          # Username
\h                          # Hostname
\w                          # Current directory
\d                          # Date
\t                          # Time
```

### Script Basics
```bash
#!/bin/bash
# Script header (shebang)

# Variables
name="John"
age=25

# Conditionals
if [ $age -gt 18 ]; then
    echo "Adult"
else
    echo "Minor"
fi

# Loops
for i in {1..5}; do
    echo "Number: $i"
done

while read line; do
    echo "Line: $line"
done < file.txt

# Functions
function greet() {
    echo "Hello, $1!"
}
greet "World"
```

### Job Control
```bash
# Job management
Ctrl+Z                      # Suspend current job
jobs                        # List jobs
fg                          # Resume foreground
bg                          # Resume background
disown                      # Remove from job table
```

---

## 6. Manajemen User & Group Lanjutan

### User Management
```bash
# Add user
useradd -m -s /bin/bash username
adduser username            # Interactive (Debian/Ubuntu)

# Modify user
usermod -aG group username  # Add to group
usermod -s /bin/zsh username # Change shell
usermod -L username         # Lock account
usermod -U username         # Unlock account

# Delete user
userdel username            # Remove user
userdel -r username         # Remove user and home

# Password management
passwd username             # Set password
chage -l username           # Password aging info
chage -E 2024-12-31 username # Set expiry date
```

### Group Management
```bash
# Add group
groupadd groupname
groupadd -g 1500 groupname  # With specific GID

# Modify group
groupmod -n newname oldname # Rename group

# Delete group
groupdel groupname

# Group membership
groups username             # Show user groups
id username                 # Detailed user info
```

### Permission Management
```bash
# Access Control Lists (ACL)
getfacl file                # Show ACL
setfacl -m u:user:rwx file  # Set user ACL
setfacl -m g:group:rx file  # Set group ACL
setfacl -x u:user file      # Remove user ACL
setfacl -b file             # Remove all ACL

# Sudo configuration
visudo                      # Edit sudoers file
# Add line: username ALL=(ALL) ALL
```

---

## 7. Manajemen Aplikasi Lanjutan

### Package Management - APT (Debian/Ubuntu)
```bash
# Update package list
apt update

# Upgrade packages
apt upgrade                 # Upgrade installed packages
apt full-upgrade            # Full system upgrade

# Install/Remove
apt install package
apt remove package
apt purge package           # Remove with configs
apt autoremove              # Remove unused dependencies

# Search and Info
apt search keyword
apt show package
apt list --installed
```

### Package Management - YUM/DNF (RedHat/CentOS)
```bash
# YUM (older systems)
yum update
yum install package
yum remove package
yum search keyword
yum info package

# DNF (newer systems)
dnf update
dnf install package
dnf remove package
dnf search keyword
dnf info package
```

### Source Installation & Archives
```bash
# TAR operations
tar -czf archive.tar.gz directory/    # Create compressed
tar -xzf archive.tar.gz               # Extract compressed
tar -tf archive.tar.gz                # List contents

# GZIP operations
gzip file                   # Compress file
gunzip file.gz              # Decompress file
zcat file.gz                # View compressed file

# Source compilation
./configure                 # Configure build
make                        # Compile
make install                # Install
```

---

## 8. Konfigurasi Jaringan Lanjutan

### Network Interface Management
```bash
# Modern tools (ip command)
ip addr show                # Show all interfaces
ip addr add 192.168.1.100/24 dev eth0  # Add IP
ip link set eth0 up         # Enable interface
ip link set eth0 down       # Disable interface

# Legacy tools (still useful)
ifconfig                    # Show interfaces
ifconfig eth0 192.168.1.100 netmask 255.255.255.0
ifup eth0                   # Enable interface
ifdown eth0                 # Disable interface
```

### Routing Configuration
```bash
# View routing table
ip route show
route -n

# Add/Remove routes
ip route add 192.168.2.0/24 via 192.168.1.1
ip route del 192.168.2.0/24
route add -net 192.168.2.0/24 gw 192.168.1.1
route del -net 192.168.2.0/24
```

### Network Troubleshooting
```bash
# Connectivity testing
ping google.com             # Test connectivity
ping -c 4 8.8.8.8          # Ping 4 times
traceroute google.com       # Trace route
tracepath google.com        # Alternative trace

# DNS testing
nslookup google.com         # DNS lookup
dig google.com              # Detailed DNS info
host google.com             # Simple DNS lookup

# Network statistics
netstat -tuln               # Listening ports
netstat -i                  # Interface statistics
ss -tuln                    # Modern netstat alternative
```

---

## 9. System Monitoring & Performance

### System Information
```bash
# Hardware info
lscpu                       # CPU information
lsmem                       # Memory information
lsblk                       # Block devices
lspci                       # PCI devices
lsusb                       # USB devices
dmidecode                   # Hardware details

# Performance monitoring
vmstat 1                    # Virtual memory statistics
iostat 1                    # I/O statistics
sar -u 1                    # CPU usage (sysstat package)
sar -r 1                    # Memory usage
```

### Log Management
```bash
# System logs
journalctl                  # Systemd logs
journalctl -f               # Follow logs
journalctl -u service       # Service logs
tail -f /var/log/syslog     # Follow syslog

# Log rotation
logrotate -d /etc/logrotate.conf  # Debug mode
logrotate -f /etc/logrotate.conf  # Force rotation
```

---

## 10. Security & Hardening

### Firewall Configuration
```bash
# UFW (Ubuntu)
ufw enable                  # Enable firewall
ufw status                  # Show status
ufw allow 22                # Allow SSH
ufw deny 80                 # Deny HTTP
ufw delete allow 22         # Remove rule

# iptables (traditional)
iptables -L                 # List rules
iptables -A INPUT -p tcp --dport 22 -j ACCEPT
iptables -A INPUT -p tcp --dport 80 -j DROP
```

### System Hardening
```bash
# File permissions
find /home -type f -perm 777  # Find world-writable files
find /etc -type f -perm +o+w  # Find world-writable configs

# Process monitoring
ps aux | grep suspicious     # Look for suspicious processes
lsof -i                     # List open network connections
netstat -tlnp               # Network connections with processes

# User monitoring
last                        # Login history
lastlog                     # Last login per user
who                         # Currently logged in users
```

---

## 11. Automation & Scheduling

### Cron Jobs
```bash
# Edit crontab
crontab -e                  # Edit user crontab
crontab -l                  # List crontab entries
crontab -r                  # Remove crontab

# Cron format: minute hour day month weekday command
# Examples:
0 2 * * *                   # Daily at 2 AM
0 */6 * * *                 # Every 6 hours
0 0 1 * *                   # First day of month
0 0 * * 0                   # Every Sunday
*/15 * * * *                # Every 15 minutes
```

### Systemd Services
```bash
# Service management
systemctl start service     # Start service
systemctl stop service      # Stop service
systemctl restart service   # Restart service
systemctl reload service    # Reload config
systemctl enable service    # Enable at boot
systemctl disable service   # Disable at boot
systemctl status service    # Service status
```

---

## 12. Backup & Recovery

### Backup Strategies
```bash
# rsync backup
rsync -av /home/ /backup/home/
rsync -av --delete /home/ /backup/home/  # Mirror backup

# tar backup
tar -czf backup_$(date +%Y%m%d).tar.gz /home/
tar -czf - /home/ | ssh user@remote 'cat > backup.tar.gz'

# dd for disk imaging
dd if=/dev/sda of=/backup/disk.img bs=4M status=progress
```

### System Recovery
```bash
# Boot from live CD/USB
# Mount system
mount /dev/sda1 /mnt
mount --bind /dev /mnt/dev
mount --bind /proc /mnt/proc
mount --bind /sys /mnt/sys
chroot /mnt

# Restore GRUB
grub-install /dev/sda
update-grub
```

---

## Latihan dan Praktikum

### Latihan 1: Script Monitoring System
```bash
#!/bin/bash
# system_monitor.sh

echo "=== System Monitor ==="
echo "Date: $(date)"
echo "Uptime: $(uptime)"
echo "CPU Usage: $(top -bn1 | grep "Cpu(s)" | cut -d' ' -f2 | cut -d'%' -f1)%"
echo "Memory Usage: $(free | grep Mem | awk '{printf("%.2f%%"), $3/$2 * 100.0}')"
echo "Disk Usage: $(df -h / | awk 'NR==2{printf "%s", $5}')"
echo "Active Users: $(who | wc -l)"
echo "Running Processes: $(ps aux | wc -l)"
```

### Latihan 2: User Management Script
```bash
#!/bin/bash
# user_management.sh

function add_user() {
    read -p "Enter username: " username
    read -s -p "Enter password: " password
    echo
    
    useradd -m -s /bin/bash $username
    echo "$username:$password" | chpasswd
    echo "User $username created successfully"
}

function list_users() {
    echo "System Users:"
    cut -d: -f1 /etc/passwd | sort
}

# Main menu
echo "1. Add User"
echo "2. List Users"
read -p "Choose option: " choice

case $choice in
    1) add_user ;;
    2) list_users ;;
    *) echo "Invalid option" ;;
esac
```

### Latihan 3: Network Configuration
```bash
#!/bin/bash
# network_config.sh

# Show current network config
echo "=== Current Network Configuration ==="
ip addr show

echo -e "\n=== Routing Table ==="
ip route show

echo -e "\n=== DNS Configuration ==="
cat /etc/resolv.conf

echo -e "\n=== Network Connectivity Test ==="
ping -c 3 8.8.8.8
```

### Tugas Praktikum
1. **Instalasi dan Konfigurasi**: Install Linux di VirtualBox, konfigurasikan network, buat user baru
2. **Script Automation**: Buat script untuk backup otomatis home directory
3. **System Monitoring**: Implementasikan monitoring CPU, memory, dan disk usage
4. **Network Troubleshooting**: Diagnosa dan perbaiki masalah konektivitas
5. **Security Hardening**: Konfigurasikan firewall dan permission file system

---

## Referensi Lanjutan

### Dokumentasi Resmi
- Linux Man Pages: `man command`
- GNU/Linux Documentation Project
- Distro-specific documentation (Ubuntu, CentOS, etc.)

### Tools Tambahan untuk Dipelajari
- **Monitoring**: htop, iotop, nethogs, iftop
- **Text Processing**: awk, sed, grep, regex
- **System**: systemd, cron, logrotate
- **Network**: tcpdump, wireshark, nmap
- **Security**: fail2ban, aide, rkhunter

### Sertifikasi Terkait
- CompTIA Linux+
- LPIC-1 (Linux Professional Institute)
- RedHat Certified System Administrator (RHCSA)
- Ubuntu Certified Professional

---

*Materi ini dirancang untuk memberikan pemahaman mendalam tentang administrasi sistem Linux, dari level dasar hingga lanjutan. Praktikkan setiap konsep secara berkala untuk memperkuat pemahaman.*