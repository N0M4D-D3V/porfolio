-- 🧠 Local Configuration file for Neovim
-- Use it for define specific configurations for this project!

-- Tech stack used in this project. Choose what u modules
local techs = {
	--  "angular",
	-- "ionic",
	--  "capacitor",
	"astro",
	"typescript",
	--  "java",
	--  "python",
	"html",
	"css",
	"markdown",
	--  "bash",
}

-- Load config modules
for _, tech in ipairs(techs) do
	local ok, err = pcall(require, "langs." .. tech)
	if not ok then
		vim.notify("Error loading config for " .. tech .. ": " .. err, vim.log.levels.ERROR)
	end
end

